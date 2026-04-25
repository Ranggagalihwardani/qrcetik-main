<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <style>
    @page {
      /* margin bawah besar supaya konten tidak menimpa footer */
      margin: 40px 30px 120px 30px; /* top right bottom left */
    }
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 13px;
      color: #111;
    }
    h1,h2,h3 { margin: 0 0 8px; }
    .content {
      /* space ekstra agar aman dari footer */
      padding-bottom: 110px;
    }
    /* FOOTER: isi payload dari DB, fixed di bawah */
    .payload-footer {
      position: fixed;
      left: 30px;
      right: 30px;
      bottom: 30px;
      font-size: 11px;
      color: #333;
      border-top: 1px solid #ccc;
      padding-top: 6px;
      text-align: center;
      word-wrap: break-word;
      word-break: break-word;
      white-space: pre-wrap; /* jaga baris-baris */
    }
    .verify {
      margin-top: 18px;
      font-size: 11px;
      color: #555;
      text-align: center;
      word-break: break-all;
    }
  </style>
</head>
<body>

  <h2>{{ $title }}</h2>

  <div class="content">
    {!! $contentHtml !!}
  </div>

  @if(!empty($payloadRaw))
    <div class="payload-footer">
      {!! nl2br(e($payloadRaw)) !!}
    </div>
  @endif

  

</body>
</html>
