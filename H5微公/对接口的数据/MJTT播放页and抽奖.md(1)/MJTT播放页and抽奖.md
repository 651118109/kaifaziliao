# MJTT_抽奖


# 说明
接口尽可能遵循 `HTTP 1.1` 协议和 `RESTFull` 风格。

服务器部署域名为 `api.gowithtommy.com`

## 通用安全规范
* 无用户凭证的请求被视作为匿名请求，需要用户权限的接口处理匿名请求时，会直接返回 `403`；
* 用户凭证通过 Header 进行传递，格式为 `Authorization: Token <token>`， 其中 `<token>` 为用户完成登录后获取的令牌，请注意大小写、空格；
* 当用户的 token 在服务器上过期后，用户的请求被返回 `401` 错误，此时需要客户端重新登录；

## 通用传参说明
* 默认情况下接口会返回 `json` 格式的数据，但是请客户端务必显式提供一个 `format` 参数，值为 `json`；
* 客户端尽可能提供规范化的 User Agent 头；
* 所有的列表页，可以通过传参控制分页，可选参数为 `page_size` 和 `page`，其中 `page_size` 为指定返回最大记录数，`page` 指定当前 `page_size` 控制条件下的分页页码，`page_size` 的默认值为 20，`page` 的默认值为 1；

#接口
景点播放页接口:
#### API:
GET /rest/scene/{scene_ID}/
#### 说明:
返回所有可用的景点数据列表
#### 参数:
* 无
#### 返回:
```
{
    "id": 3869,
    "name": "美景城堡",
    "name_en": "meijingchengbao",
    "image": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2Fbf6f1f4c20c8eee0b894690e6f747eba7f28175a.png?x-oss-process=image/quality,q_30",
    "latitude": 39.923332,
    "longitude": 116.354473,
    "is_locked": false,
    "is_published": true,
    "is_icon": false,
    "city": 135,
    "city_name": "北京",
    "country": 40,
    "country_name": "中国大陆",
    "audios": [
        {
            "id": 2859,
            "title": "",
            "author": "",
            "performer": "",
            "audio": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2F8d224131d9cbe8334e1e162687d67721d8e79299.mp3",
            "size": 0,
            "download_count": 1354,
            "link_url": ""
        }
    ],
    "images": [
        {
            "user": {
                "id": 39171,
                "nickname": "测试张",
                "avatar": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fpeople%2Favatar%2F2fd4ed7e1c07879787d17f2775c7d69a28c0953e.png",
                "type": "INDI-FREE"
            },
            "scene": 3869,
            "image": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2F9d56257d6712d98a1e643dee8db6fac4bfba3f25.png",
            "type": 0,
            "sort": 0
        },
        {
            "user": {
                "id": 39171,
                "nickname": "测试张",
                "avatar": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fpeople%2Favatar%2F2fd4ed7e1c07879787d17f2775c7d69a28c0953e.png",
                "type": "INDI-FREE"
            },
            "scene": 3869,
            "image": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2F1c039db87f1826eabe594fbd0422a4f23843f8a5.png",
            "type": 0,
            "sort": 0
        },
        {
            "user": {
                "id": 39171,
                "nickname": "测试张",
                "avatar": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fpeople%2Favatar%2F2fd4ed7e1c07879787d17f2775c7d69a28c0953e.png",
                "type": "INDI-FREE"
            },
            "scene": 3869,
            "image": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2F395343126fd4a8ad52451a8688f1e2bef6ecf07a.png",
            "type": 0,
            "sort": 0
        }
    ],
    "contributor": {
        "name": "写稿人0号",
        "avatar": "https://music.gowithtommy.com/mjtt_backend_server%2Ftest%2Fdata%2Fb6146ac049f3b8e6435a9ca12180c15f798f318b.png",
        "tag": "第一个",
        "introduction": "97年留学法国
            },
    "scene_information": {
        "busy_season_price": 78,
        "low_season_price": 87,
        "open_time": "早上8点到晚上19点",
        "play_days": 22,
        "phone_number": "13131348934",
        "bus_line": "5路 6路 8路",
        "self_driving_line": "北京"
    },
    "map_image": null,
    "is_dynamic_map": false,
    "navi_image": null,
    "is_navigation": false,
    "recognition_open": false,
    "navi_left_latitude": 0,
    "navi_left_longitude": 0,
    "navi_right_latitude": 0,
    "navi_right_longitude": 0,
    "subscenes": 6,
    "audios_size_sum": 1.16,
    "center_latitude": null,
    "center_longitude": null,
    "scaling": null,
    "sum_count": 0,
    "scene_count": 0,
    "sort": 9999989,
    "version": 1,
    "is_major": false,
    "mark": 0
}
```

子景点播放页接口:
#### API:
GET /rest/subscene/{subscene_ID}/
#### 说明:
返回所有可用的子景点数据列表
#### 参数:
* 无
#### 返回:

```
        {
            "id": 6720,
            "name": "高级神职人员的陵墓",
            "name_en": "",
            "number": "",
            "image": "https://music.gowithtommy.com/mjtt_backend_server%2Fprod%2Fdata%2F9d32250388e4a454d2c93dfa689457af88259dae.jpg?x-oss-process=image/quality,q_30",
            "longitude": 0,
            "latitude": 0,
            "is_locked": false,
            "is_published": true,
            "floor_manage": {
                "is_icon": false,
                "is_locked": false
            },
            "sort": 6770,
            "scene": 2794,
            "scene_data": {
                "id": 2794,
                "name": "圣母升天大教堂",
                "name_en": "Dormition Cathedral",
                "image": "https://music.gowithtommy.com/mjtt_backend_server%2Fprod%2Fdata%2Fc95433b799af91e7e3df7c64a82a9d2de171a368.jpg?x-oss-process=image/quality,q_30",
                "is_locked": true
            },
            "audios": [
                {
                    "id": 6737,
                    "title": "圣母升天大教堂-高级神职人员的陵墓",
                    "author": "king",
                    "performer": "",
                    "audio": "https://music.gowithtommy.com/mjtt_backend_server%2Fprod%2Fdata%2Fe89a013314c887b52d4412016cabc8c7957cde9f.mp3",
                    "size": 0.37,
                    "download_count": 1947,
                    "link_url": "https://api.gowithtommy.com/play.html?scene_ID=6720"
                }
            ],
            "images": [
                {
                    "user": null,
                    "sub_scene": 6720,
                    "image": "https://music.gowithtommy.com/mjtt_backend_server%2Fprod%2Fdata%2Fef402380908c16556ebf27838b496edbf827d295.jpg",
                    "type": 0,
                    "sort": 0
                }
            ],
            "contributor": {},
            "tag": null,
            "city": 31,
            "city_name": "莫斯科",
            "country": 31,
            "country_name": "俄罗斯"
        },

```

## 转盘奖品列表：
#### API:
GET /rest/lucky_wheel/
#### 说明:
返回所有可用的奖品数据，中奖纪录 和 抽奖规则
#### 参数:
* 无
#### 返回:
```
{
    "msg": "",
    "code": "",
    "data": {
        "turntable_data": [
            {
                "prize_name": "2个听听币",
                "luckOdds": 0.12,
                "link_url": "",
                "reward_type": 2
            },
            {
                "prize_name": "解锁城市",
                "luckOdds": 0.06,
                "link_url": "",
                "reward_type": 7
            },
            {
                "prize_name": "谢谢参与",
                "luckOdds": 0.35,
                "link_url": "",
                "reward_type": 8
            }
        ],
        "luck_record": [],
        "luckdrawrule": [
            {
                "id": 1,
                "content": "1.每个用户每天有一次免费抽奖的机会\r\n\r\n2.二个听听币抽取一次（除免费抽奖外）"
            }
        ]
    }
}
```

## 转盘抽奖接口：
#### API:
GET /rest/luck_draw/
#### 说明:
返回抽中的奖品信息
#### 参数:
* 无
#### 返回:
```

{
    "msg": "",
    "code": 0,
    "data": {
        "result": "谢谢参与"
    }
}
```

