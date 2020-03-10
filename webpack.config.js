const wpConfig = require('./node_modules/@wordpress/scripts/config/webpack.config');

module.exports = {
  ...wpConfig,
  module: {
    ...wpConfig.module,
    rules: [
      ...wpConfig.module.rules,
      {
        // Add sass and image stuff
      }
    ]
  }
};
