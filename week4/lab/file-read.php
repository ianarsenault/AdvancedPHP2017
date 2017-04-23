<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File Details</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
        <link rel='stylesheet' type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        include './views/navigation.html.php';

        $filename = filter_input(INPUT_GET, 'filename');


        /*         * ***************UPDATE FILE**************** */
        $file = '.' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;

        //http://php.net/manual/en/fileinfo.constants.php
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type = $finfo->file($file);

//        var_dump($type);
//
//        //http://php.net/manual/en/function.filesize.php
//        var_dump(filesize($file));

        /*
         * To delete a file use unlink
         *     unlink($file);
         */


        // http://php.net/manual/en/class.splfileinfo.php
        $finfo = new SplFileInfo($file);

//        if ($finfo->isFile()) {
//            var_dump($finfo->getRealPath(), '<br/><br/>');
//            var_dump($finfo->getFilename(), '<br/><br/>');
//            var_dump(date("l F j, Y, g:i a", $finfo->getMTime()), '<br/><br/>');
//            var_dump($finfo->getSize(), '<br/><br/>');
//            var_dump($finfo->getPathname(), '<br/><br/>');
//        }

        // Set empty variable to pass html string
        $displayFile = "";
        switch ($type) {
            case "image/png":
            case "image/jpeg":
            case "image/gif":
                $displayFile = '<img src="' . $file . '" />';
                break;
            case "text/plain":
                $newFile = new SplFileObject($file, "r");
                $contents = $newFile->fread($newFile->getSize());
                $displayFile = '<textarea class="textarea">'. $contents .'</textarea>';
                break;
            case "application/pdf":
            case "text/html":
                $displayFile = '<iframe height="800" width="700" src="' . $file . '"></iframe>';
                break;
            default:
                $displayFile = '';
                break;
        }

        include './views/file-read.html.php';
        
        ?>
    </body>
</html>
