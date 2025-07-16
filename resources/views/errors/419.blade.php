  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>419 | Page Expired</title>
  </head>

  <body>
      @include('errors.generic', [
          'code' => '419',
          'title' => 'Page Expired',
          'message' => 'Sesi Anda telah berakhir. Silakan refresh halaman dan coba lagi.',
      ])

  </body>

  </html>
