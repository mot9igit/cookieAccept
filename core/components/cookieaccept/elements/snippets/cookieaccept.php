<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var cookieAccept $cookieAccept */
$corePath = $modx->getOption('cookieaccept_core_path', $scriptProperties, $modx->getOption('core_path') . 'components/cookieaccept/');
$cookieAccept = $modx->getService('cookieAccept', 'cookieAccept', $corePath . 'model/', $scriptProperties);
if (!$cookieAccept) {
    return 'Could not load cookieAccept class!';
}

$cookieAccept->initialize($modx->context->key);

$fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
$path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}

$out = array();

$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl.cookieAccept');
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);

$active = $modx->getOption("cookieaccept_active");
if($active) {
    $policy_page = $modx->getOption("cookieaccept_page_policy");
    if (is_numeric($policy_page)) {
        $out["policy_page"] = $modx->makeUrl($policy_page, '', '', 'full');
    } else {
        $out["policy_page"] = $policy_page;
    }

    $output = $pdoFetch->getChunk($tpl, $out);
    if (!empty($toPlaceholder)) {
        $modx->setPlaceholder($toPlaceholder, $output);
        return '';
    }

    return $output;
}
