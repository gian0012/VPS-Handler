# VPS Handler
An easy VPS Handler class.
# 📄 Installation (<a href='https://getcomposer.org/'>Composer</a>)
Install the extension with Composer: 
<pre><code>composer require gian0012/vps-handler</code></pre>
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


    
 
