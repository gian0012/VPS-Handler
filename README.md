# VPS Handler
An easy VPS Handler extension for <a href='https://github.com/skrtdev/NovaGram'>NovaGram Library</a>.
# 📄 Installation (<a href='https://getcomposer.org/'>Composer</a>)
Install the extension with Composer:
<pre><code>composer require gian0012/vpshandler dev-main</code></pre>

You can also download the <a href='https://github.com/gian0012/VPS-Handler/blob/main/src/vpsHandler.php'>vpsHandler.php</a> file and put it into your bot folder <b>directory</b>.
# 🗄 Useful Methods
<b> • </b><code> $Bot->startBot('sessionName','/dir/to/your/bot/file.php');</code> \
<b> • </b><code> $Bot->reboot();</code> \
<b> • </b><code> $Bot->uptime();</code> \
<b> • </b><code> $Bot->getIP();</code> \
<b> • </b><code> $Bot->serviceRestart($serviceName);</code> 
# ➕ Example
There is an example <a href='https://github.com/gian0012/VPS-Handler/blob/main/examples/panel.php'>PHP File</a>, with a Telegram-based panel(with <b>InlineKeyboard</b>).
# 📑 Example code
```php
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

$Bot = new Bot('YOUR_TOKEN');

$Bot->onCommand('uptime', function (Message $message) {
    $a = $Bot->startBot('session','bot/file.php');
    $message->reply("Bot started!");
});
    
 
