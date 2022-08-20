<?php
$wpnativeAppSettings = [
    "name"=> "Test App",
    "headerToHide"=> "#header",
    "footerToHide"=> "#footer",
    "otherHide"=> ["#elemeent1","#element2","#element3"],
    "splash"=> [
      "backgroundColor"=> "#ecec",
      "backgroundImage"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
    ],
    "topBarNav"=>[
      "styles"=> [
        "backgroundColor"=> "#ececec",
        "statusBarTextColor"=> "#fff",
        "bannerLogo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
        "topBarTextColor"=> "#ececec",
        "topBarIconColor"=> "#ececec"
      ],
    ],
    "bottomBarNav"=>[
      "styles"=> [
        "backgroundColor"=> "",
        "defaultIconColor"=> "",
        "activeIconColor"=> "",
      ],
      "items"=> [
        [
          "id"=> 1,
          "url"=> "",
          "icon"=> "",
          "name"=> "",
          "isExternal"=> true/false,
          "topNav"=>[
              "designType"=> 1,
              "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
              "text"=> "Home",
              "alignment"=> "middle",
          ]
        ],
        [
          "id"=> 2,
          "url"=> "",
          "icon"=> "",
          "name"=> "",
          "isExternal"=> true/false,
          "topNav"=>[
            "designType"=> 2,
            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
            "hamburger"=> [
              "backgroundColor"=> "#ececec",
              "menuIcon"=> "#ececec",
            ]
          ]
        ],
        [
          "id"=> 3,
          "url"=> "",
          "icon"=> "",
          "name"=> "",
          "isExternal"=> true/false,
          "topNav"=>[
            "designType"=> 3,
            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
            "buttons"=> [
              [
                "isExternal"=>true,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/link",
              ],
              [
                "isExternal"=>false,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/link2",
              ],
              [
                "isExternal"=>false,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/link3",
              ],
            ]
          ]
        ],
        [
          "id"=> 4,
          "url"=> "",
          "icon"=> "",
          "name"=> "",
          "isExternal"=> true/false,
          "topNav"=>[
            "designType"=> 4,
            "logo"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
            "leftButton"=> [
              [
                "isExternal"=>true,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/leftbutton",
              ],
            ],
            "rightButtons"=> [
              [
                "isExternal"=>false,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/rightbutton1",
              ],
              [
                "isExternal"=>false,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/rightbutton2",
              ],
              [
                "isExternal"=>true,
                "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
                "url"=> "https://wpnativeapps.com/rightbutton3",
              ],
            ]
          ]
        ],
      ],
    ],
    "prompts"=>[
      "promptLocatoinService"=>true,
      "promptItems"=>[
      "pushNotification"=>[
        "styles"=> [
          "backgroundColor"=> "#ececec",
          "textColor"=> "#000",
          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
          "title"=>"Prompt Title Text",
          "description"=>"Prompt Description",
          "acceptButtonText"=>"Accept",
          "acceptButtonColor"=>"#ececec",
        ]
      ],
      "trackingService"=>[
        "styles"=> [
          "backgroundColor"=> "#ececec",
          "textColor"=> "#000",
          "icon"=> "https://wpnativeapps.com/wp-content/plugins/wp-native-apps/admin/images/WPNativeApps-Icon.png",
          "title"=>"Prompt Title Text",
          "description"=>"Prompt Description",
          "acceptButtonText"=>"Accept",
          "acceptButtonColor"=>"#ececec",
        ]
      ]
    ]
  ],
  "authentication"=>[
    "accountRequired"=>true,
    "authenticationPage"=>"https://wpnativeapps.com/my-account"
  ]
  ];


?>
