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

    "accepted"         => ":attribute debe ser aceptado.",
    "active_url"       => ":attribute no es un URL válido.",
    "after"            => ":attribute debe ser una fecha luego de :date.",
    "alpha"            => ":attribute sólo puede contener letras.",
    "alpha_dash"       => ":attribute puede contener letras, números y guiones solamente.",
    "alpha_num"        => ":attribute puede contener sólo letras y números.",
    "array"            => ":attribute debe ser un arreglo.",
    "before"           => ":attribute debe ser una fecha antes de :date.",
    "between"          => array(
        "numeric" => ":attribute debe estar entre :min y :max.",
        "file"    => ":attribute debe tener entre :min y :max kilobytes.",
        "string"  => ":attribute debe tener entre :min y :max caracteres.",
        "array"   => ":attribute debe tener entre :min and :max objetos.",
    ),
    "confirmed"        => "La confirmación de :attribute no coincide.",
    "date"             => ":attribute no es una fecha válida.",
    "date_format"      => ":attribute no coincide con el formato :format.",
    "different"        => ":attribute y :other deben ser diferentes.",
    "digits"           => ":attribute debe tener :digits dígitos.",
    "digits_between"   => ":attribute debe tener entre :min y :max dígitos.",
    "email"            => "El formato de :attribute es incorrecto.",
    "exists"           => ":attribute seleccionado es incorrecto.",
    "image"            => ":attribute debe ser una imagen.",
    "in"               => ":attribute seleccionado es incorrecto.",
    "integer"          => ":attribute debe ser un entero.",
    "ip"               => ":attribute debe ser una IP válida.",
    "max"              => array(
        "numeric" => ":attribute no puede ser mayor a :max.",
        "file"    => ":attribute no puede ser más grande de :max kilobytes.",
        "string"  => ":attribute no puede ser más grande de :max characters.",
        "array"   => ":attribute no puede tener más de :max objetos.",
    ),
    "mimes"            => ":attribute debe ser un archivo de tipo: :values.",
    "min"              => array(
        "numeric" => ":attribute debe ser al menos :min.",
        "file"    => ":attribute debe tener al menos :min kilobytes.",
        "string"  => ":attribute debe tener al menos :min characters.",
        "array"   => ":attribute debe tener al menos :min objetos.",
    ),
    "not_in"           => ":attribute seleccionado es incorrecto.",
    "numeric"          => ":attribute debe ser un número.",
    "regex"            => "El formato de :attribute es incorrecto.",
    "required"         => ":attribute es requerido.",
    "required_if"      => ":attribute es requerido cuando :other es :value.",
    "required_with"    => ":attribute es requerido cuando :values está presente.",
    "required_without" => ":attribute es requerido cuando :values no está presente.",
    "same"             => ":attribute y :other deben coincidir.",
    "size"             => array(
        "numeric" => ":attribute debe ser :size.",
        "file"    => ":attribute debe tener :size kilobytes.",
        "string"  => ":attribute debe tener :size caracteres.",
        "array"   => ":attribute debe contener :size objetos.",
    ),
    "unique"           => ":attribute ya ha sido utilizado.",
    "url"              => "El formato de :attribute es incorrecto.",

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

    'attributes' => array(),
    "alpha_spaces" => ":attribute puede contener sólo letras y espacios.",
    "alphanum_spaces" => ":attribute puede contener sólo letras, números y espacios.",
    "alphanumdotspaces" => ":attribute puede contener sólo letras, números, espacios y puntos.",

);
