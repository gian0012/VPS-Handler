# VPS Handler
An easy VPS Handler class.
# 📄 Installation (<a href='https://getcomposer.org/'>Composer</a>)
Install the extension with GitHub: 
<pre><code>gh repo clone gian0012/VPS-Handler</code></pre>
# 🗄 Useful Methods
<b> • </b><code> $vps->startBot('sessionName','/dir/to/your/bot/file.php');</code> \
<b> • </b><code> $vps->reboot();</code> \
<b> • </b><code> $vps->uptime();</code> \
<b> • </b><code> $vps->getIP();</code> \
<b> • </b><code> $vps->serviceRestart($serviceName);</code> 

# 📑 Example code
```php
use gian0012\VPSHandler;

require "vendor/autoload.php";


$who = $vps->whoami();
echo $sessionList  // i.e. root
```


    
 
