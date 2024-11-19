<?php

class cookieAccept
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('cookieaccept_core_path', $config, $this->modx->getOption('core_path') . 'components/cookieaccept/');
        $assetsUrl = $this->modx->getOption('cookieaccept_assets_url', $config, $this->modx->getOption('assets_url') . 'components/cookieaccept/');
        $assetsPath = $this->modx->getOption('cookieaccept_assets_path', $config, $this->modx->getOption('base_path') . 'assets/components/cookieaccept/');

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'version' => '0.0.3',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        $this->modx->addPackage('cookieaccept', $this->config['modelPath']);
        $this->modx->lexicon->load('cookieaccept:default');

        if ($this->pdoTools = $this->modx->getParser()->pdoTools) {
            // $this->pdoTools->setConfig($this->config);
        }
    }

    /**
     * Initializes component into different contexts.
     *
     * @param string $ctx The context to load. Defaults to web.
     * @param array $scriptProperties Properties for initialization.
     *
     * @return bool
     */
    public function initialize($ctx = 'web', $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }
        $this->config = array_merge($this->config, $scriptProperties);
        $this->config['ctx'] = $ctx;
        $this->modx->lexicon->load('cookieaccept:default');

        if ($ctx != 'mgr' && (!defined('MODX_API_MODE') || !MODX_API_MODE) && !$this->config['json_response']) {
            $config = $this->pdoTools->makePlaceholders($this->config);

            // Register CSS
            $css = trim($this->modx->getOption('cookieaccept_frontend_css'));
            if (!empty($css) && preg_match('/\.css/i', $css)) {
                if (preg_match('/\.css$/i', $css)) {
                    $css .= '?v=' . substr(md5($this->config['version']), 0, 10);
                }
                $this->modx->regClientCSS(str_replace($config['pl'], $config['vl'], $css));
            }

            // Register JS
            $js = trim($this->modx->getOption('cookieaccept_frontend_js'));
            if (!empty($js) && preg_match('/\.js/i', $js)) {
                if (preg_match('/\.js$/i', $js)) {
                    $js .= '?v=' . substr(md5($this->config['version']), 0, 10);
                }
                $this->modx->regClientScript(str_replace($config['pl'], $config['vl'], $js));


                $js_setting = array(
                    'cssUrl' => $this->config['cssUrl'] . 'web/',
                    'jsUrl' => $this->config['jsUrl'] . 'web/',
                    'actionUrl' => $this->config['actionUrl'],
                    'cookie_lifetime' => $this->modx->getOption('cookieaccept_cookie_lifetime'),
                    'ctx' => $ctx
                );

                $data = json_encode($js_setting, true);
                $this->modx->regClientStartupScript(
                    '<script>cookieacceptConfig = ' . $data . ';</script>',
                    true
                );
            }
        }
        return true;
    }

}