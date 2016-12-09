<!doctype html>
<html lang="en-US">
    <head>
        <script>
        var require = {
            "baseUrl": "/assets/frontend"
        };
    </script>

    <title>Frontend RequireJS Bootstrapped</title>
    <script  type="text/javascript"  src="/assets/frontend/requirejs/require.js"></script>
    <script  type="text/javascript"  src="/assets/frontend/mage/requirejs/mixins.js"></script>
    <script  type="text/javascript"  src="/assets/frontend/requirejs-config.js"></script>
</head>
<body>
    <h1>To Do</h1>

    <ul>    
        <li>Pull down translations?</li>
        <li>Pull down merged configuration</li>
        <li><s>bundle up all possible javascript files</s></li>
        <li>Replace magento-2-1-1.dev with ---?</li>
        <li>Does .html template loading work?</li>
        <li>Does scope loading work?</li>        
    </ul>
            
    <script>
        require.config({
            deps: [
                'jquery',
                'mage/translate',
                'jquery/jquery-storageapi'
            ],
            callback: function ($) {
                'use strict';

                var dependencies = [],
                    versionObj;

                $.initNamespaceStorage('mage-translation-storage');
                $.initNamespaceStorage('mage-translation-file-version');
                versionObj = $.localStorage.get('mage-translation-file-version');

                if (versionObj.version !== 'edbfe158dbc65db3a1fe2dbbaa85779919a6414d') {
                    dependencies.push(
                        'text!js-translation.json'
                    );

                }

                require.config({
                    deps: dependencies,
                    callback: function (string) {
                        if (typeof string === 'string') {
                            $.mage.translate.add(JSON.parse(string));
                            $.localStorage.set('mage-translation-storage', string);
                            $.localStorage.set(
                                'mage-translation-file-version',
                                {
                                    version: 'edbfe158dbc65db3a1fe2dbbaa85779919a6414d'
                                }
                            );
                        } else {
                            $.mage.translate.add($.localStorage.get('mage-translation-storage'));
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/x-magento-init">
        {
            "*": {
                "mage/cookies": {
                    "expires": null,
                    "path": "/",
                    "domain": ".magento-2-1-1.dev",
                    "secure": false,
                    "lifetime": "3600"
                }
            }
        }
    </script>
</body>
</html>
