<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    "url" => "فرمت آدرس :attribute اشتباه است.",
    "auth.failed" => "فرمت آدرس :attribute اشتباه است.",
    'dumbpwd' => 'لطفا از رمز قوی تری استفاده بکنید',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "f_name" => "نام",
        "l_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "آدرس",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "codemeli" => "کد ملی",
        "role" => "سمت",
        "max" => "بیشترین نمره",
        "bist" => "نمره از بیست",
        "captcha" => "حروف تصویر",
        "body" => "متن",
        "subject" => "عنوان",
        "to" => "دریافت کننده",
        "old password" => "رمز قدیمی",
        "new password" => "رمز جدید",
        "confirm password" => "تکراررمز",
        "daraje" => "درجه سختی",
        "file" => "فایل",
        "class" => "کلاس",
        "classnamber" => "کلاس",
        "paye" => "پایه",
        "auther" => "تهیه کننده",
        "price" => "قیمت",
        "vahed" => "تعداد واحد",
        "old_password" => "رمز قبلی",
        "new_password" => "رمز جدید",
        "confirm_password" => "تکرار رمز جدید",
        "class_id" => "کلاس",
        "rowteacher" => "کلاس و درس",
        "message" => "متن پیام",
        "items" => "موارد",
        "users" => "افراد",
        "dars" => "درس",
        "patchfile" => "فایل و یا عکس",
        "countquestions" => "تعداد سوالات رندوم",
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'father_name' => 'نام پدر',
        'national_code' => 'کد ملی',
        'certificate_number' => 'شماره شناسنامه',
        'military_service' => 'وضعیت سربازی',
        'certificate_city' => 'شهر صدور شناسنامه',
        'city_id' => 'شهر محل تولد',
        'birth_date' => 'تاریخ تولد',
        'is_married' => 'وضعیت تاهل',
        'post_code' => 'کد پستی',
        'emergency_name' => 'نام یکی از بستگان جهت تماس ضروری ',
        'emergency_relation' => ' نسبت در تماس ضروری',
        'emergency_phone' => 'شماره همراه در تماس ضروری',
        'was_kanoon' => 'دانش آموز کانون بودید؟',
        'worked_kanoon' => 'سابقه کار در کانون دارید؟',
        'institute_name' => 'نام موسسه',
        'from_date' => 'از تاریخ',
        'until_date' => 'تا تاریخ',
        'how_many_years_kanoon' => 'چند سال؟',
        'what_grade_kanoon' => 'چه مقاطعی؟',
        'what_years_kanoon' => 'چه سال هایی؟',
        'how_many_years_worked_kanoon' => 'چند سال؟',
        'old_kanoon_manager' => 'نام مدیر واحد قبلی؟',
        'is_full_time' => 'وضعیت کاری',
        'office_id' => 'واحدی که مشغول به کارید؟',
        'kanoon_role_id' => 'عنوان شغلی؟',
        'major_id' => 'رشته',
        'university_major' => 'رشته',
        'university_id' => 'نام دانشگاه',
        'school_id' => 'نام مدرسه',
        'stop_working_reason' => 'علت قطع همکاری',
        'salary' => 'حقوق',
    ),
);
