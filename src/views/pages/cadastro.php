<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base?>/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?=$base?>/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        
        <form method="POST" action="<?=$base?>/cadastro">
        <h2 style="text-align: center; margin-bottom: 10px; color: #477dbb">Cadastro</h2>
                        <?php if(!empty($flash)):?>
                        <div class="flash"><?php echo $flash;?></div>
                        <?php endif;?>
                    
         
             <input placeholder="Digite seu nome" class="input" type="text" name="name" />

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua data de nascimento" class="input" type="text" name="date" id="date" />

            <input class="button" type="submit" value="Cadastro" />

            <a href="<?=$base?>/login">Já tem conta? Faça seu Login</a>
        </form>
    </section>
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.querySelector('#date'),
            {
                mask: '00/00/0000'
            }
        )
    </script>
</body>
</html>