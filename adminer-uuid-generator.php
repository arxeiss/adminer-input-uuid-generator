<?php

class AdminerUUIDGenerator {
    private $columns;
    private $matchingTypes;
    private $buttonText;

    function __construct($columns = ['id'], $matchingTypes = ['uuid'], $buttonText = null) {
        $this->columns = $columns;
        $this->matchingTypes = $matchingTypes;
        $this->buttonText = $buttonText ?: 'Generate UUID';
    }

    function head() {
        ?>
        <script<?php echo nonce(); ?>>
            function uuidv4() {
                // https://stackoverflow.com/a/2117523
                if (window.crypto) {
                    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, function (c) {
                        return (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16);
                    });
                }
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            }
            document.addEventListener("DOMContentLoaded", function(e) {
                [].forEach.call(document.querySelectorAll('.js-generateUUID'), function(btn) {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault(); e.stopPropagation();
                        e.target.parentElement.querySelector("input").value = uuidv4()
                        return false;
                    })
                });
            });
          </script>
        <?
    }

    function editInput($table, $field, $attrs, $value) {
        if (
            in_array($field['type'], $this->matchingTypes)
            && (in_array($field['field'], $this->columns) || in_array($table."::".$field['field'], $this->columns))
        ) {

            $maxlength = (int)$field["length"];

            return "<input value='" . h($value) . "'" . ($maxlength ? " data-maxlength='$maxlength'" : "")
                ."$attrs> <button class=\"js-generateUUID\">".$this->buttonText."</button>";
        }
    }
}
