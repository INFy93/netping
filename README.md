## Netping

Система управления сигнализацией NetPing.
- Таблица с точками, позволяющая узнать статус конкретной точки. Обновление - раз в 20 сек.
- Возможность добавлять и редактировать точку.
- (Для конкретного размещения) Просмотр скриншота с камеры (обновление каждые 8 сек)
- Разделение пользовательских ролей
- Просмотр, фильтрация и сортировка логов

## Обязательные параметры .env
Параметры ниже работают с точками NetPing v2.

Значения переменных меняем под свою систему:
```
NETPING_LOGIN = "http://login:pass@" //логин и пароль для входа на точку

POWER_STATE = "/io.cgi?io1" //питание
DOOR_STATE = "/io.cgi?io2" //статус открытия двери
ALARM_STATE = "/io.cgi?io3" //статус сирены
NETPING_STATE = "/io_get.cgi" //статус охраны

ALARM_CONTROL = "/io.cgi?io3&mode=" //изменение состояния охраны

NETPING_TIMEOUT = 3 //таймаут HTTP-запроса
```
Эти параметры используются в коде и являются обязательными. Имена переменных не меняем!

Если у вас есть камеры на объектах с точками NetPing, сконфигурируйте ваши камеры так, чтобы они возвращали скриншоты потока в формате jpeg.
Необходимые параметры env для камер:

```
CAM_LOGIN = "login" //логин
CAM_PASS = "pass" //пароль
CAM_LINK = "link" //ссылка на jpeg-скриншот потока
```
IP камер можно хранить в базе или прописывать явно (но лучше в базе).
В текущем проекте получение скриншота реализовано так:

```
public function getCamera($netping_id)
    {
        header("Content-Type: image/jpeg");
        $login = env('CAM_LOGIN');
        $pass = env('CAM_PASS');
        $link = env('CAM_LINK');

        $netping = Netping::find($netping_id);

        try {
            $screenshot = HTTP::timeout(env('NETPING_TIMEOUT'))
                ->withHeaders([
                    'Content-Type' => 'image/jpeg'
                ])
                ->withBasicAuth($login, $pass)
                ->get($netping->camera_ip . $link);
        } catch (ConnectionException $exp) {
            return "Не удалось подключиться к камере";
        }
        $img = imagecreatefromstring($screenshot);
        imagejpeg($img);
        imagedestroy($img);
        return $img;
    }
```

## Лицензия

OpenSorce by Laravel: [MIT license](https://opensource.org/licenses/MIT).
