<!-- DO NOT CHANGE THIS FILE!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php if (isset($title)): ?>
        <title><?=$template['page-title']?></title>
    <?php else: ?>
        <title>PXI Bench</title>
    <?php endif; ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>/img/heading/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url()?>/img/heading/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>/img/headingfavicon-16x16.png">
    <link rel="manifest" href="<?= base_url()?>/img/heading/site.webmanifest">
    <link rel="mask-icon" href="<?= base_url()?>/img/heading/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?= base_url()?>/img/heading/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?= base_url()?>/img/heading/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">



    <?php if (isset($sheets_to_load)):
                foreach($sheets_to_load as $sheet): ?>
    <!--Loaded css sheet: .--> <link href="<?= base_url()?>/css/<?=$sheet?>" rel="stylesheet"></link>
                <?php endforeach; ?>
    <?php endif; ?>
    <!--Loaded JS script: .--><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <?php if (isset($scripts_to_load)):
                foreach($scripts_to_load as $script):?>
    <!--Loaded JS script: .--><script src="<?= base_url()?>/js/<?=$script?>" defer></script>
                <?php endforeach; ?>
    <?php endif; ?>
    <!--Loaded JS script: .--><script src="<?= base_url()?>/node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
    <!--Loaded JS script: .--><script src="https://d3js.org/d3.v7.min.js" defer></script>

</head>
<body>
<!-- DO NOT CHANGE THIS FILE!-->