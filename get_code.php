<html>
<head>
    <title>Attendance Confirmation</title>
    <link rel=stylesheet href=styles.css>
    <link rel=stylesheet href=../styles.css>
    <script src=../jquery.min.js></script>
<!--    <script src=../index.js></script>-->
    <style>
         body {
             color: white;
             text-align: center;
         }
        table {
            width: 100%;
        }
        td {
            padding: .3em;
        }
        tbody > tr > td:first-child {
            text-align: right;
            width: 43%;
        }
    </style>
    <script>
        function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                  succeed = document.execCommand("copy");
            } catch(e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }
        addEventListener("load", function(event) {
            console.log("event");
            document.getElementById("copyClick")
                .addEventListener("click", function(event) {
                event.preventDefault();
                console.log(copyToClipboard(
                    document.getElementById("copyLink")));
            });
        });
    </script>
</head>
<body>


<?php

$pass = 'ThisIsGospel';
$algo = 'AES-128-CBC';

$fname = '';
if (isset($_GET['fname'])) {
    $fname = $_GET['fname'];
}
$lname = '';
if (isset($_GET['lname'])) {
    $lname = $_GET['lname'];
}
$email = '';
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

$code = @openssl_encrypt("$fname $lname $email", $algo, $pass);

$url = "https://www.polyhacks.com/confirm/index.php?id=$code";

echo '<span id=copyLink>';
echo $url;
echo '</span> (<a id=copyClick href=#>Copy</a>)';
echo '<br><br><br>';
?>
    
    <form method=get action=get_code.php>
        <table>
            <thead>
                <tr>
                    <th colspan=2>Student Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>First Name</td>
                    <td><input name="fname"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input name="lname"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input name="email"></td>
                </tr>
            </tbody>
        </table>
        <br>
        <input type=submit value="Get URL">
    </form>
        
        
</body>
</html>