  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>503 | Service Unavailable</title>
  </head>

  <body>
      @include('errors.generic', [
          'code' => '503',
          'title' => 'Service Unavailable',
          'message' => 'Situs sedang dalam perawatan. Kami akan kembali segera. Terima kasih atas pengertiannya.',
      ])
  </body>

  </html>
