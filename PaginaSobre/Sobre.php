<?php
    echo "<script>alert('Seja Bem vindo a nossa pagina Sobre Nós');</script>";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuExpress</title>
    <style>
        body {
            font-family: 'Open Sans', 'Lato', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            color: #333;
            background-color: #f5f5f5;
        }

        .cabecalho-da-pagina {
            background-color: #FF5733;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #cc4c37;
        }

        .titulo-principal {
            margin: 0;
            font-size: 2.5em;
        }

        .menu-de-navegacao {
            background-color: #333;
            text-align: center;
            padding: 10px 0;
        }

        .link-do-menu {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            font-weight: bold;
        }

        .link-do-menu:hover {
            background-color: #555;
        }

        .area-de-conteudo {
            padding: 20px;
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .secao-de-comida {
            margin-bottom: 30px;
            border-bottom: 2px dashed #ccc;
            padding-bottom: 20px;
        }

        .titulo-da-secao {
            color: #ff6347;
            font-size: 2em;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .carrossel-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .carrossel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carrossel-item {
            min-width: 100%;
            position: relative;
        }

        .carrossel-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }

        .carrossel-legenda {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 1.2em;
        }

        .carrossel-botoes {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            gap: 10px;
        }

        .carrossel-btn {
            background-color: #FF5733;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .carrossel-btn:hover {
            background-color: #cc4c37;
        }

        .rodape-da-pagina {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.9em;
        }

        .informacoes-de-contato {
            text-align: center;
            line-height: 1.6;
        }

        .lista-de-contato {
            list-style: none;
            padding: 0;
        }

        .item-contato {
            margin-bottom: 10px;
            padding: 8px 0;
        }
    </style>
</head>
<body>

    <div class="cabecalho-da-pagina">
        <h1 class="titulo-principal">Aromá de Vó</h1>
        <p>A melhor comida caseira, feita com amor e carinho!</p>
    </div>

    <div class="menu-de-navegacao">
        <a href="#menu" class="link-do-menu">Nosso Menu</a>
        <a href="#sobre" class="link-do-menu">Sobre Nós</a>
        <a href="#contato" class="link-do-menu">Fale Conosco</a>
    </div>

    <div class="area-de-conteudo">

        <!-- Carrossel de Imagens com PHP -->
        <div class="secao-de-comida" id="menu">
            <h2 class="titulo-da-secao">Nosso Cardápio</h2>
            <div class="carrossel-container">
                <div class="carrossel" id="carrossel">
                    <?php
                    // Array com as imagens e legendas
                    $imagens = [
                        [
                            'arquivo' => 'lasanhaupgrade.png',
                            'legenda' => 'Lasanha Bolonhesa'
                        ],
                        [
                            'arquivo' => 'caradosanduiche.png',
                            'legenda' => 'Nosso chef fazendo um sanduiche'
                        ],
                        [
                            'arquivo' => 'sanduicheupgrade.png',
                            'legenda' => 'Sanduiche Artesanal'
                        ],
                        [
                            'arquivo' => 'saladacaesarupgrade.png',
                            'legenda' => 'Salada Caesar'
                        ],
                        [
                            'arquivo' => 'troco.png',
                            'legenda' => 'Tiramisu'
                        ]
                    ];
                    
                    foreach ($imagens as $index => $imagem) {
                        echo '
                        <div class="carrossel-item">
                            <img src="' . $imagem['arquivo'] . '" alt="' . $imagem['legenda'] . '" class="carrossel-img">
                            <div class="carrossel-legenda">' . $imagem['legenda'] . '</div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="carrossel-botoes">
                <button class="carrossel-btn" onclick="moverCarrossel(-1)">Anterior</button>
                <button class="carrossel-btn" onclick="moverCarrossel(1)">Próxima</button>
            </div>
        </div>

        <div class="secao-de-comida" id="sobre">
            <h2 class="titulo-da-secao">Nossa História</h2>
            <p>O Sabor da Tradição: Conheça o "Aroma da Vó"
Em uma esquina charmosa, onde o cheiro de tempero caseiro se mistura à brisa da tarde, reside o "Aroma da Vó". Mais do que um restaurante, é um portal para as memórias mais queridas, um refúgio onde cada garfada conta uma história de família e dedicação.
Nossa jornada começou na cozinha de uma matriarca, Dona Aurora, que acreditava que o segredo de qualquer prato reside no tempo e no amor. Ela nos ensinou que não há pressa para a perfeição. Por isso, aqui, o feijão é cozido lentamente, o molho de tomate apura por horas e o pão é assado todas as manhãs, exalando um perfume que convida a entrar.
No "Aroma da Vó", você não encontrará pratos da moda ou invenções efêmeras. Nosso menu é um tributo à culinária brasileira raiz, aquela que conforta a alma. Temos a feijoada de quarta-feira, rica e completa, que atrai clientes de toda a cidade. O bife à parmegiana, com sua crosta crocante e queijo derretido, é um clássico inegável. E para os amantes de sabores mais leves, o frango grelhado com ervas frescas e salada colhida na horta local é a escolha perfeita.
Mas a experiência não se limita ao paladar. O ambiente é acolhedor, com mesas de madeira rústica e paredes adornadas com fotos antigas da família. A trilha sonora é suave, composta por clássicos que embalam a conversa e criam uma atmosfera de tranquilidade. É o lugar ideal para um almoço de negócios descontraído, um encontro romântico ou, simplesmente, para se presentear com uma refeição que abraça.
E não se esqueça das sobremesas! O pudim de leite condensado, com sua calda de caramelo na medida certa, é a assinatura da casa. Cada colherada é um final feliz para a sua refeição.
Venha nos visitar. Deixe-se levar pelo "Aroma da Vó" e descubra o verdadeiro sabor da comida feita com o coração. Estamos abertos de segunda a sábado, esperando para lhe servir não apenas um prato, mas uma dose de felicidade. Infelizmente, após 10 anos, o restaurante foi fechado por causa da pandemia que influêciou agressivamente os lucros, o que levou a sua falência e sua migração para o Ifood e o mercado Digital. </p>
        </div>

        <div class="secao-de-comida" id="contato">
            <h2 class="titulo-da-secao">Como Pedir</h2>
            <div class="informacoes-de-contato">
                <ul class="lista-de-contato">
                    <li class="item-contato"><strong>Telefone para Pedidos:</strong> (99) 99999-9999</li>
                    <li class="item-contato"><strong>WhatsApp:</strong> (99) 98888-8888</li>
                    <li class="item-contato"><strong>Horário de Funcionamento:</strong> Segunda a Sexta: 11:00h às 15:00h</li>
                    <li class="item-contato"><strong>Sábados:</strong> 11:00h às 14:00h</li>
                    <li class="item-contato"><strong>Domingos e Feriados:</strong> Fechado</li>
                    <li class="item-contato"><strong>Endereço:</strong> Rua das Flores, 123 - Centro</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="rodape-da-pagina">
        <p>&copy; MenuExpress. Todos os direitos reservados.</p>
    </div>

    <script>
        let indiceAtual = 0;
        const carrossel = document.getElementById('carrossel');
        const items = document.querySelectorAll('.carrossel-item');
        const totalItems = items.length;

        function moverCarrossel(direcao) {
            indiceAtual += direcao;
            
            if (indiceAtual < 0) {
                indiceAtual = totalItems - 1;
            } else if (indiceAtual >= totalItems) {
                indiceAtual = 0;
            }
            
            const offset = -indiceAtual * 100;
            carrossel.style.transform = `translateX(${offset}%)`;
        }

        // Inicializa o carrossel
        moverCarrossel(0);

        setInterval(() => {
            moverCarrossel(1);
        },3000);
    </script>

</body>
</html>