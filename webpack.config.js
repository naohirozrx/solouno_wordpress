const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
  plugins: [
    new BrowserSyncPlugin({
      host: "myapp.dev",
      port: 3080,
      proxy: 'http://myapp.dev:8000',
      https: false,
      files: [
                {
                    match: [
                        '**/*.php',
                        '**/*.css'
                    ],
                    fn: function(event, file) {
                        if (event === "change") {
                            const reload = () => {
                              const bs = require('browser-sync').get('bs-webpack-plugin');
                              bs.reload();
                            }
                            setTimeout(reload, 1000);
                        }
                    }
                }
            ]
    })
  ]
}

