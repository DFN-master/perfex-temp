<?php
/**
 * This file is part of the ZBateson\MailMimeParser project.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace ZBateson\MailMimeParser\Header\Consumer\Received;

use ZBateson\MailMimeParser\Header\Consumer\ConsumerService;
use ZBateson\MailMimeParser\Header\Part\HeaderPartFactory;
use ZBateson\MailMimeParser\Header\Consumer\GenericConsumer;
use ZBateson\MailMimeParser\Header\Part\CommentPart;

/**
 * Consumes simple literal strings for parts of a Received header.
 *
 * Starts consuming when the initialized $partName string is located, for
 * instance when initialized with "FROM", will start consuming on " FROM" or
 * "FROM ".
 *
 * The consumer ends when any possible "Received" header part is found, namely
 * on one of the following tokens: from, by, via, with, id, for, or when the
 * start token for the date stamp is found, ';'.
 *
 * The consumer allows comments in and around the consumer... although the
 * Received header specification only allows them before a part, for example,
 * technically speaking this is valid:
 *
 * "FROM machine (host) (comment) BY machine"
 *
 * However, this is not:
 *
 * "FROM machine (host) BY machine WITH (comment) ESMTP"
 *
 * The consumer will allow both.
 *
 * @author Zaahid Bateson
 */
class GenericReceivedConsumer extends GenericConsumer
{
    /**
     * @var string the current part name being parsed.
     */
    protected $partName;

    /**
     * Constructor overridden to include $partName parameter.
     *
     * @param ConsumerService $consumerService
     * @param HeaderPartFactory $partFactory
     * @param string $partName
     */
    public function __construct(ConsumerService $consumerService, HeaderPartFactory $partFactory, $partName)
    {
        parent::__construct($consumerService, $partFactory);
        $this->partName = $partName;
    }

    /**
     * Returns the name of the part being parsed.
     *
     * This is always the lower-case name provided to the constructor, not the
     * actual string that started the consumer, which could be in any case.
     *
     * @return string
     */
    protected function getPartName()
    {
        return $this->partName;
    }

    /**
     * Overridden to return a CommentConsumer.
     *
     * @return AbstractConsumer[] the sub-consumers
     */
    protected function getSubConsumers()
    {
        return [ $this->consumerService->getCommentConsumer() ];
    }

    /**
     * Returns true if the passed token matches (case-insensitively)
     * $this->getPartName() with optional whitespace surrounding it.
     *
     * @param string $token
     * @return bool
     */
    protected function isStartToken($token)
    {
        $pattern = '/^\s*(' . preg_quote($this->getPartName(), '/') . ')\s*$/i';
        return (preg_match($pattern, $token) === 1);
    }

    /**
     * Returns true if the token matches (case-insensitively) any of the
     * following, with optional surrounding whitespace:
     *
     * o from
     * o by
     * o via
     * o with
     * o id
     * o for
     * o ;
     *
     * @param string $token
     * @return boolean
     */
    protected function isEndToken($token)
    {
        return (preg_match('/^\s*(from|by|via|with|id|for|;)\s*$/i', $token) === 1);
    }

    /**
     * Returns a whitespace separator (for filtering ignorable whitespace
     * between parts), and a separator matching the current part name as
     * returned by $this->getPartName().
     *
     * @return string[] an array of regex pattern matchers
     */
    protected function getTokenSeparators()
    {
        return [
            '\s+',
            '(\A\s*)?(?i)' . preg_quote($this->getPartName(), '/') . '(?-i)\s+'
        ];
    }

    /**
     * Overridden to combine all part values into a single string and return it
     * as the first element, followed by any comment elements as subsequent
     * elements.
     *
     * @param \ZBateson\MailMimeParser\Header\Part\HeaderPart[] $parts
     * @return \ZBateson\MailMimeParser\Header\Part\HeaderPart[]|\ZBateson\MailMimeParser\Header\Part\CommentPart[]
     */
    protected function processParts(array $parts)
    {
        $strValue = '';
        $ret = [];
        $filtered = $this->filterIgnoredSpaces($parts);
        foreach ($filtered as $part) {
            if ($part instanceof CommentPart) {
                $ret[] = $part;
                continue;    // getValue() is empty anyway, but for clarity...
            }
            $strValue .= $part->getValue();
        }
        array_unshift($ret, $this->partFactory->newReceivedPart($this->getPartName(), $strValue));
        return $ret;
    }
}
