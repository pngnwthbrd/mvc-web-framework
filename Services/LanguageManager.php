<?php
namespace Services;

class LanguageManager
{
    protected $lang;
    protected $text_array = [];
    protected $filename;

    public function __construct($filename = '')
    {
        global $session;

        if ($session->get('language') !== false)
            $this->lang = $session->get('language');
        else
            $this->lang = 'german';

        $this->filename = (($filename !== '') ? $filename : "*");
        $this->_parseLanguageFiles();
    }

    public function getText($section, $key)
    {
        return $this->textArray[$section][$key];
    }

    protected function _parseLanguageFiles()
    {
        foreach (glob($lang_files) as $lang_file) {
            $lang_file_content = parse_ini_file($lang_file, true);

            foreach ($lang_file_content as $sec => $pairs)
                $this->text_array[$sec] = $pairs;
        }
        $this->_parseConnectorsLanguageFiles();
    }
}