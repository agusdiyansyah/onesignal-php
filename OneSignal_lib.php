<?php

class OneSignal {

    // Initialize
    protected $appId = "";
    protected $restApiKey = "";

    // Notification
    protected $playerId = array();
    protected $title = "";
    protected $content = "";

    protected $response = "";
    protected $log = "";

    public function init ($opt = array()) {
        if (!empty($opt['appId'])) {
            $this->appId = $opt['appId'];
        }

        if (!empty($opt['restApiKey'])) {
            $this->restApiKey = $opt['restApiKey'];
        }
        return $this;
    }

    /**
     * Send notification
     * @return [type] [description]
     */
    public function send ($opt = array()) {

        if (empty($opt['content']) OR count($opt['content']) == 0) {
            $this->setLog("", "Content tidak boleh kosong");
        } elseif (empty($opt['title']) OR count($opt['title']) == 0) {
            $this->setLog("", "Title tidak boleh kosong");
        } elseif (empty($opt['content']['en'])) {
            $this->setLog("", "Content EN tidak boleh kosong");
        } elseif (empty($opt['title']['en'])) {
            $this->setLog("", "Title EN tidak boleh kosong");
        } else {
            $body = array(
    			"app_id" => $this->appId,
    			"included_segments" => array("All"),
                "data" => array("foo" => "bar"),
                "headings" => $opt["title"],
    			"contents" => $opt["content"],
    		);

            $body = json_encode($body);

            $this->setLog("Initialize", $this->json($body));

            $ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json; charset=utf-8",
                    "Authorization: Basic $this->restApiKey"
                )
            );
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    		curl_setopt($ch, CURLOPT_HEADER, FALSE);
    		curl_setopt($ch, CURLOPT_POST, TRUE);
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    		$response = curl_exec($ch);
    		curl_close($ch);

            $this->setLog("Response", $this->json($response));
        }

        return $this;
    }

    public function log () {
        echo $this->log;
    }

    protected function json($json) {
        header("Content-Type: application/json");
        if (!is_string($json)) {
            if (phpversion() && phpversion() >= 5.4) {
                return json_encode($json, JSON_PRETTY_PRINT);
            }
            $json = json_encode($json);
        }
        $result      = '';
        $pos         = 0;               // indentation level
        $strLen      = strlen($json);
        $indentStr   = "\t";
        $newLine     = "\n";
        $prevChar    = '';
        $outOfQuotes = true;

        for ($i = 0; $i < $strLen; $i++) {
            $copyLen = strcspn($json, $outOfQuotes ? " \t\r\n\",:[{}]" : "\\\"", $i);
            if ($copyLen >= 1) {
                $copyStr = substr($json, $i, $copyLen);
                $prevChar = '';
                $result .= $copyStr;
                $i += $copyLen - 1;
                continue;
            }

            $char = substr($json, $i, 1);

            if (!$outOfQuotes && $prevChar === '\\') {
                $result .= $char;
                $prevChar = '';
                continue;
            }

            if ($char === '"' && $prevChar !== '\\') {
                $outOfQuotes = !$outOfQuotes;
            } else if ($outOfQuotes && ($char === '}' || $char === ']')) {
                $result .= $newLine;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            } else if ($outOfQuotes && false !== strpos(" \t\r\n", $char)) {
                continue;
            }


            $result .= $char;

            if ($outOfQuotes && $char === ':') {
                $result .= ' ';
            } else if ($outOfQuotes && ($char === ',' || $char === '{' || $char === '[')) {
                $result .= $newLine;
                if ($char === '{' || $char === '[') {
                    $pos++;
                }
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }
            $prevChar = $char;
        }

        return $result;
    }

    protected function setlog ($title = "", $content) {
        if ($title != "") {
            $this->log .= "==================================\n$title\n==================================\n";
        }

        $this->log .= "$content\n\n";

        return true;
    }

}
