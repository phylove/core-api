<?php


/**
 * Custom Validation 
 */

$validationMessage =   [
    'accepted'             => ':attribute harus diizinkan.',
    'active_url'           => ':attribute bukan suatu URL yang valid.',
    'after'                => ':attribute harus suatu tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus suatu tanggal setelah atau sama dengan to :date.',
    'alpha'                => ':attribute hanya boleh diisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh diisi huruf, angka, dan dashes.',
    'alpha_num'            => ':attribute hanya boleh diisi huruf dan angka.',
    'array'                => ':attribute harus sebuah array.',
    'before'               => ':attribute harus suatu tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus suatu tanggal sebelum atau sama dengan to :date.',
    'between'              => [
        'numeric' => ':attribute harus diantara :min dan :max.',
        'file'    => ':attribute harus diantara :min dan :max kilobytes.',
        'string'  => ':attribute harus diantara :min dan :max characters.',
        'array'   => ':attribute harus memiliki diantara :min dan :max items.',
    ],
    'boolean'              => ':attribute harus diisi true atau false.',
    'confirmed'            => ':attribute konfirmasi tidak cocok.',
    'date'                 => ':attribute bukan suatu tanggal yang valid.',
    'date_format'          => ':attribute tidak cocok dengan format :format.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus :digits digit.',
    'digits_between'       => ':attribute harus diantara :min dan :max digit.',
    'dimensions'           => ':attribute memiliki dimensi yang tidak valid.',
    'distinct'             => ':attribute memiliki suatu duplicate nilai.',
    'email'                => ':attribute harus suatu email yang valid.',
    'exists'               => ':attribute terpilih tidak valid.',
    'file'                 => ':attribute harus suatu file.',
    'filled'               => ':attribute field harus memiliki suatu nilai.',
    'image'                => ':attribute harus sebuah image.',
    'in'                   => ':attribute terpilih tidak valid.',
    'in_array'             => ':attribute tidak terdapat di :other.',
    'integer'              => ':attribute harus sebuah bilangan bulat.',
    'ip'                   => ':attribute harus suatu IP address yang valid.',
    'ipv4'                 => ':attribute harus suatu IPv4 address yang valid.',
    'ipv6'                 => ':attribute harus suatu IPv6 address yang valid.',
    'json'                 => ':attribute harus suatu JSON string yang valid.',
    'max'                  => [
        'numeric' => ':attribute mungkin lebih besar dari :max.',
        'file'    => ':attribute mungkin lebih besar dari :max kilobytes.',
        'string'  => ':attribute mungkin lebih besar dari :max characters.',
        'array'   => ':attribute tidak boleh lebih dari :max item.',
    ],
    'mimes'                => ':attribute harus suatu file of type: :values.',
    'mimetypes'            => ':attribute harus suatu file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute harus sekurang-kurangnya :min.',
        'file'    => ':attribute harus sekurang-kurangnya :min kilobytes.',
        'string'  => ':attribute harus sekurang-kurangnya :min karakter.',
        'array'   => ':attribute harus memiliki sekurang-kurangnya :min items.',
    ],
    'not_in'               => ':attribute yang terpilih tidak valid.',
    'numeric'              => ':attribute harus suatu angka.',
    'present'              => ':attribute harus ada.',
    'regex'                => 'format :attribute tidak valid.',
    'required'             => ':attribute tidak boleh kosong.',
    'required_if'          => ':attribute tidak boleh kosong saat :other adalah :value.',
    'required_unless'      => ':attribute tidak boleh kosong unless :other adalah in :values.',
    'required_with'        => ':attribute tidak boleh kosong saat :values ada.',
    'required_with_all'    => ':attribute tidak boleh kosong saat :values ada.',
    'required_without'     => ':attribute tidak boleh kosong saat tidak ada :values.',
    'required_without_all' => ':attribute tidak boleh kosong saat tidak terdapat :values.',
    'same'                 => ':attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => ':attribute harus memiliki ukuran :size.',
        'file'    => ':attribute harus memiliki ukuran :size kilobytes.',
        'string'  => ':attribute harus memiliki ukuran :size characters.',
        'array'   => ':attribute harus memiliki ukuran :size items.',
    ],
    'string'               => ':attribute harus suatu string.',
    'timezone'             => ':attribute harus suatu zona yang valid.',
    'unique'               => ':attribute sudah ada.',
    'uploaded'             => ':attribute gagal upload.',
    'url'                  => 'format :attribute tidak valid.'
];

$validator = app()->make('validation');
$validator->setMessages($validationMessage);
