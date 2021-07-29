# AAWP Obfuscator for WordPress
### _Automatically obfuscate your aawp links._

[![N|Solid](https://cdn.getaawp.com/wp-content/themes/aawp/assets/img/site-footer-logo.png)](https://getaawp.com/)

This WP plugin directly obfuscate your external aawp links, you just have to activate the plugin and it's done!

### Before :
```html
<a class="aawp-button" href="https://www.amazon.fr/dp/B07MBN8RW2?tag=yoursupertag" title="SEE" target="_blank" rel="nofollow">SEE</a>
```
### After :
```html
<span class="aawp-button" title="SEE" data-aawp-web="Z3hZNGMzY3lZMGd4Z3pFMUUz==">SEE</span>
```