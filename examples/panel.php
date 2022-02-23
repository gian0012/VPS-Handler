<?php

require 'vendor/autoload.php';
include 'vpsHandler.php';

use \skrtdev\NovaGram\{Bot, Database};
use \skrtdev\Telegram\{Message, Text, CallbackQuery};

$Bot = new Bot("BOT-TOKEN", [  //type here the token of your bot
    "debug" => "your-id",  //type here the token for debug
    "parse_mode" => "HTML",
    "json_payload" => true,
    "restart_on_changes" => true,



    "database" => [

        "dbname" => $dbname,
        "dbuser" => $dbuser,
        "dbpass" => $dbpass,
        "prefix" => $dbprefix,
        "host" => $dbhost,
        "driver" => $dbdriver
    ],
]);






$Bot->onTextMessage(function (Message $message) use ($Bot){
    $user = $message->from;
    $chat = $message->chat;
    $text = $message->text;
    $userid = $user->id;
    $username = $message->from->username;
    $firstname = $message->from->first_name;
    $cstat = $chat->status();

    $adminID = [
        "616616541", //type here the ID of the users that can interact with the bot.
    ];


    $backbutton = [
        "reply_markup" => [
            "inline_keyboard" => [
                [
                    [
                        "text" => "🔙 Go Back",
                        "callback_data" => "start"
                    ]
                ]
            ]
        ]
    ];

    if(in_array($userid,$adminID)) {


        if (str_starts_with($text, "/start")) {

            $chat->sendMessage("Hi <b><a href='t.me/$username'>$firstname</a></b>!\n\n ➕<i>Use the button below to see the VPS panel</i>\n\n⚙️ Developed by <a href='t.me/gian0012'>Γιάν</a>", [
                "disable_web_page_preview" => true,
                "reply_markup" => [
                    "inline_keyboard" => [
                        [
                            [
                                "text" => " ℹ️VPS Info",
                                "callback_data" => "vpsinfo"
                            ],
                            [
                                "text" => "➕ Start Bot",
                                "callback_data" => "startbot"
                            ],
                        ],
                        [
                            [
                                "text" => " ⚠️ Service Restart",
                                "callback_data" => "service"
                            ],
                            [
                                "text" => " 💢 Restart VPS",
                                "callback_data" => "restart"
                            ]
                        ]

                    ]
                ]
            ]);

        }

        if($text == "whoami"){

            $a = $Bot->whoami();
            $message->reply($a);
        }
    } elseif (!in_array($userid, $adminID)) {
        $message->reply("You can't interact with the bot!");
    }


    $sessionName =  $chat->conversation("sessionName");
    $dir = $chat->conversation("dir");
    $serviceName = $chat->conversation("serviceName");

    if(isset($cstat)){

        if($cstat == "insertsession"){
            $chat->status("insertdir");
            $chat->conversation("sessionName",$text);
            $chat->sendMessage("🗂<i> Now insert the dire where is located the PHP file bot.</i>",$backbutton);
        }

        if($cstat == "insertdir"){

            $chat->conversation("dir",$text);
            $Bot->startBot($sessionName,$dir);
            $chat->sendMessage("<i>Bot started successsfully.</i>");
        }

        if($cstat == "service"){

            $chat->conversation("serviceName",$text);
            $Bot->serviceRestart($serviceName);
            $chat->sendMessage("<i>Service restarted succesfully</i>",$backbutton);
        }
    }
});




$Bot->onCallbackQuery(function (CallbackQuery $callback_query) use ($Bot) {
    $data = $callback_query->data;
    $message = $callback_query->message;
    $chat = $message->chat;
    $user = $callback_query->from;
    $userid = $user->id;
    $username = $callback_query->from->username;
    $firstname = $callback_query->from->first_name;

    if($data == "start"){

        $message->editText("Hi <b><a href='t.me/$username'>$firstname</a></b>!\n\n ➕<i>Use the button below to see the VPS panel</i>\n\n⚙️ Developed by <a href='t.me/gian0012'>Γιάν</a>", [
            "disable_web_page_preview" => true,
            "reply_markup" => [
                "inline_keyboard" => [
                    [
                        [
                            "text" => " ℹ️VPS Info",
                            "callback_data" => "vpsinfo"
                        ],
                        [
                            "text" => "➕ Start Bot",
                            "callback_data" => "startbot"
                        ],
                    ],
                    [
                        [
                            "text" => " ⚠️ Service Restart",
                            "callback_data" => "service"
                        ],
                        [
                            "text" => " 💢 Restart VPS",
                            "callback_data" => "restart"
                        ]
                    ]

                ]
            ]
        ]);

    }

    if($data == "vpsinfo"){
        $ip = $Bot->getIP();
        $ram = $Bot->ramUse();
        $uptime = $Bot->uptime();


        $message->editText("ℹ️<i> Your VPS info:</i>\n\n🪐 <b>Server:</b> $ip\n\n🔋<b>Ram Use:</b> \n $ram\n\n⌛️ <b>Uptime:</b> $uptime", [
            "reply_markup" => [
                "inline_keyboard" => [
                    [
                        [
                            "text" => "🔙 Go Back 🔙",
                            "callback_data" => "start"
                        ]
                    ]
                ]
            ]
        ]);
    }

    if($data == "startbot"){
        $chat->status("insertsession");

        $message->editText("➕ <i>Type the name of the screen session.</i>", [
            "reply_markup" => [
                "inline_keyboard" => [
                    [
                        [
                            "text" => "🔙 Go Back 🔙",
                            "callback_data" => "start"
                        ]
                    ]
                ]
            ]
        ]);
    }

    if($data == "service") {
        $chat->status("service");

        $message->editText("➕ <i>Type the name of the service that you want to restart.</i>", [
            "reply_markup" => [
                "inline_keyboard" => [
                    [
                        [
                            "text" => "🔙 Go Back 🔙",
                            "callback_data" => "start"

                        ]
                    ]
                ]
            ]
        ]);

    }

    if($data == "restart"){
        $message->editText("⚠️<code> Tap the confirm button below if you want to reboot your VPS.</code>", [
            "reply_markup" => [
                "inline_keyboard" => [
                    [
                        [
                            "text" => "✅ confirm",
                            "callback_data" => "confirm"
                        ],
                        [
                            "text" => " 🔙 Go Back",
                            "callback_data" => "start"
                        ]
                    ]
                ]
            ]
        ]);
    }

    if($data == "confirm"){
        $message->editText("Server rebooted.");
        $Bot->reboot();


    }


});
$Bot->start();
