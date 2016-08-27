<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <b><br>Hi, {{ $user->first_name }}  </b>

    <div>
      <br>
      <p>Thank you for signing up for access to Glend.</p>
      <p>To activate and complete your membership, click the following link:</p>

      <a href="{{ route('register.verify', $user->hash_token) }}"> {{ route('register.verify', $user->hash_token) }} </a>


    </div>
  </body>
</html>