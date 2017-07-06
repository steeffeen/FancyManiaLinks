<?php

namespace FML\Script\Features;

use FML\Controls\Entry;
use FML\Script\Builder;
use FML\Script\Script;
use FML\Script\ScriptInclude;
use FML\Script\ScriptLabel;

/**
 * Script Feature for submitting an Entry
 *
 * @author    steeffeen
 * @copyright FancyManiaLinks Copyright © 2017 Steffen Schröder
 * @license   http://www.gnu.org/licenses/ GNU General Public License, Version 3
 */
class EntrySubmit extends ScriptFeature
{

    /**
     * @var Entry $entry Entry
     */
    protected $entry = null;

    /**
     * @var string $url Submit url
     */
    protected $url = null;

    /**
     * Construct a new Entry Submit
     *
     * @api
     * @param Entry  $entry (optional) Entry Control
     * @param string $url   (optional) Submit url
     */
    public function __construct(Entry $entry = null, $url = null)
    {
        if ($entry) {
            $this->setEntry($entry);
        }
        if ($url) {
            $this->setUrl($url);
        }
    }

    /**
     * Get the Entry
     *
     * @api
     * @return Entry
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the Entry
     *
     * @api
     * @param Entry $entry Entry Control
     * @return static
     */
    public function setEntry(Entry $entry)
    {
        $entry->setScriptEvents(true)
              ->checkId();
        $this->entry = $entry;
        return $this;
    }

    /**
     * Get the submit url
     *
     * @api
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the submit url
     *
     * @api
     * @param string $url Submit url
     * @return static
     */
    public function setUrl($url)
    {
        $this->url = (string)$url;
        return $this;
    }

    /**
     * @see ScriptFeature::prepare()
     */
    public function prepare(Script $script)
    {
        $script->setScriptInclude(ScriptInclude::TextLib, ScriptInclude::TextLib);
        $controlScript = new ControlScript($this->entry, $this->getEntrySubmitScriptText(), ScriptLabel::EntrySubmit);
        $controlScript->prepare($script);
        return $this;
    }

    /**
     * Get the entry submit event script text
     *
     * @return string
     */
    protected function getEntrySubmitScriptText()
    {
        $url       = $this->buildCompatibleUrl();
        $entryName = $this->entry->getName();
        $link      = Builder::escapeText($url . $entryName . "=");
        return "
declare Value = TextLib::URLEncode(Entry.Value);
OpenLink({$link}^Value, CMlScript::LinkType::Goto);
";
    }

    /**
     * Build the submit url compatible for the entry parameter
     *
     * @return string
     */
    protected function buildCompatibleUrl()
    {
        $url             = $this->url;
        $parametersIndex = stripos($url, "?");
        if (!is_int($parametersIndex) || $parametersIndex < 0) {
            $url .= "?";
        } else {
            $url .= "&";
        }
        return $url;
    }

}
