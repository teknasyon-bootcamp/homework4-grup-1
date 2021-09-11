# :tada: Birinci Grup Gururla Sunar :tada:

Bu projemizde basit bir DB sınıfı yazıp ardından ailemize ve arkadaşlarımı daha fazla zaman ayırabilirdik ancak yapmadık. 

Bunun yerine proje isterlerini aşıp basit bir ORM (Object Relational Mapping - Nesne İlişkisel Eşleme ) yapısı kurduk. 

Peki bunu neden yaptık? Çünkü neden yapmayalım...
:technologist:

Peki ne demek bu? Koda eklediğim her modelin en basit CRUD işlemlerine bile sıfırdan katı SQL sorguları yazmak yerine sırtımı nesne tabanlı programlamaya dayıyorum demek. Örneğin bir model üzerinde bunun örneğini gösterelim. Modelimizin adı User olsun. 1 numaralı id ye sahip olan User'ı çekmek için sadece şunu yazmamız yetecektir. 

```php 
$user = User::find(1);
```

Hadi bir örnek daha yapalım. Tüm kullanıcıları çekelim. 

```php 
$users = User::All();
```

Koda eklenecek her modelde ORM'in çalışabilmesi için sadece iki şeye ihtiyacımız var. DB sınıfından kalıtım alması ve tüm propertylerinin koda eklenmiş olması.

```php 
<?php


require_once 'db.class.php';


class User extends DB
{
    public int $id;
    public string $firstname = '';
    public string $surname = '';
}

```


---
## Emeği Geçen Babacanlar 

| Adı | Github Kullancısı |
| ----------- | ----------- |
| Esra ULUTÜRK | [@esrauluturk](https://github.com/esrauluturk) |
| Haydar ŞAHİN | [@haydar](https://github.com/haydar/) |
| Gökhan GEMİCİ | [@gokhangemici](https://github.com/gokhangemici) |
| Enes Fırat DOĞAN | [@enesfirat](https://github.com/enesfirat) |

---

# Ödev 4: MySQL - Yazı Listesi

## index.php

Veritabanında yer alan `post` listesi gösterilmelidir. Eğer `?post=X` şeklinde bir query parametresi verildiyse (`$_GET`) sadece ilgili `post` gösterilmelidir.

## manage.php

Veritabanındaki `post` listesi gösterilmeli. Eğer `?action=edit&post=X` şeklinde ise ilgili yazıyı düzenleyecek bir form gösterilmeli. Eğer `?action=delete&post=X` şeklinde ise ilgili yazı silinmeli. Eğer `?action=create` şeklinde ise yeni yazının ekleneceği bir form gösterilmelidir.

## db.class.php

İçerisinde sadece `DB` sınıfının tanımlanması gerekiyor. Bu `DB` sınıfı `Post` sınıfında veya nesnesinde kullanılacaktır. Veritabanı ile haberleşme için kullanılması gerekiyor.

## post.class.php

İçerisinde sadece `Post` sınıfının tanımlanması gerekiyor. Bu `Post` sınıfı ile:

- Yazı listesine ulaşılması
- Yazı detay bilgilerine ulaşılması
- Yeni yazı ekleme işlemlerinin yapılması
- Yazıyı güncelleme işlemlerinin yapılması
- Yazıyı silme işlemlerinin yapılması

hedeflenmesi gerekiyor.

---

**Not: Ödevler sadece bireysel değil toplu değerlendirilecektir. Bu sebeple gerekli geliştirmeler için iş bölümlendirilmesinin yapılması gerekiyor. Grup olarak kendi aranızda işleri bölerek beraber çalışma yapın. Kendi aranızda ve diğer gruplarla da yardımlaşabilirsiniz. Eğitmene ve asistanlara da her zaman danışabilirsiniz. :blush:**

**Not: Ayar bilgileri veya harici fonksiyonellikler için ek dosyalar oluşturabilirsiniz.**

**Not: Yukarıda özetlenen işlemleri sadece _ilgili_ dosyalarda gerçekleştirin. Örneğin, `Post` sınıfı içerisinde direk veritabanı ile ilgili bir işlem yapmayın veya süperglobal/global bir değişkene erişmeyin.**

**Not: Ödevin ilgili kısımlarında hata kontrollerinin yapılması ve herhangi bir hata durumunda istemcinin bilgilendirilmesi gerekiyor.**

**Not: Ödevler manuel kontrol edilecektir.**

---

# Örnek Kontrol Adımları

1. `index.php` - post listesi görünüyor mu? Herhangi bir postun başlığına tıklanabiliyor mu?
2. `index.php?post=1` - ilgili post detayı görünmesi gerekiyor. Post listesi olmaması gerekiyor.
3. `index.php?post=2` - farklı bir post detayı görünmesi gerekiyor.
4. `manage.php` - post listesi görünüyor mu? Yeni yazı eklemek için bir link bulunuyor mu? Yazı listesinde herbir yazı için düzenleme ve silme linkleri bulunuyor mu?
5. `manage.php?action=create` - yeni post oluşturma formu görüntüleniyor mu?
6. `manage.php` veya `manage.php?action=store` - Yeni post oluşturma işlemi yapıldı mı?
7. `manage.php?action=edit&post=1` - İlgili postu güncelleme için form görüntüleniyor mu? Formdaki alanların değerleri ilgili postun değerleri ile güncellenmiş mi?
8. `manage.php` veya `manage.php?action=update&post=1` - İlgili postun güncelleme işlemi yapıldı mı?
9. `manage.php?action=delete&post=1` - İlgili postun silinme işlemi yapıldı mı? (İsteyenler farklı metodlarla `manage.php` kaynak adresini kullanabilir)

---

İyi çalışmalar :wink: :pencil2: 
