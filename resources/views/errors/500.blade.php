  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>500 | Internal Server Error</title>
  </head>

  <body>
      @include('errors.generic', [
          'code' => '500',
          'title' => 'Internal Server Error',
          'message' => 'Terjadi kesalahan pada server. Silakan coba beberapa saat lagi atau hubungi admin.',
      ])
  </body>

  </html>
