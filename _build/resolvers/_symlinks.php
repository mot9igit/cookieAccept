<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/cookieAccept/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/cookieaccept')) {
            $cache->deleteTree(
                $dev . 'assets/components/cookieaccept/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/cookieaccept/', $dev . 'assets/components/cookieaccept');
        }
        if (!is_link($dev . 'core/components/cookieaccept')) {
            $cache->deleteTree(
                $dev . 'core/components/cookieaccept/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/cookieaccept/', $dev . 'core/components/cookieaccept');
        }
    }
}

return true;