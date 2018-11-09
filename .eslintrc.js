module.exports = {
  extends: [
    // add more generic rulesets here, such as:
    'eslint:recommended',
    'plugin:vue/recommended'
  ],
  rules: {
    "vue/html-self-closing" : "off",
    "vue/name-property-casing": ["error", "kebab-case"],
    "import/no-unresolved": "off", // no support .vue
    "import/extensions": "off", // no support .vue
    "indent": "off",
    "class-methods-use-this": "off",
    "no-new": "off", // used no initialize vue instance
    "vue/script-indent": ["error", 2, {"baseIndent": 1, "switchCase": 1}],
    "object-shorthand": ["error", "properties"],
    "comma-dangle": ["error", {
      "arrays": "always-multiline",
      "objects": "always-multiline",
      "imports": "always-multiline",
      "exports": "always-multiline",
      "functions": "ignore"
    }],
    "prefer-destructuring": "off",
  },
  overrides: [
    {
      "files": ["store/modules/*.js"],
      "rules": {
        "no-param-reassign": "off"
      }
    }
  ]
};
