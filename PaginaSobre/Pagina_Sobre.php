<?php
    echo "<script>alert('Seja Bem vindo a nossa pagina Sobre Nós');</script>";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroma de Vó</title>
    <style>
        body {
            font-family: font-family: 'Open Sans', 'Lato', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonte da pagina */
            margin: 0; /* Remove margens padrão do navegador */
            color: #333; /* Cor do texto principal */
            background-image: url('imagem_de_fundo.png');
            background-size: 250px 200px;
        }

        /* Estilos para o cabeçalho principal */
        .cabecalho-da-pagina {
            background-color: #FF5733; /* Cor Primaria */
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #cc4c37; /* Borda mais escura */
        }

        /* Estilos para o título grande */
        .titulo-principal {
            margin: 0;
            font-size: 2.5em;
        }

        /* Estilos para a navegação (links) */
        .menu-de-navegacao {
            background-color: #333; /* Fundo escuro para contraste */
            text-align: center;
            padding: 10px 0;
        }

        /* Estilos para cada link do menu */
        .link-do-menu {
            color: white;
            text-decoration: none; /* Remove sublinhado */
            padding: 10px 20px;
            display: inline-block; /* Permite espaçamento */
            font-weight: bold;
        }

        /* Estilos para quando o mouse passar por cima do link */
        .link-do-menu:hover {
            background-color: #555;
        }

        /* Estilos para a área principal de conteúdo */
        .area-de-conteudo {
            padding: 20px;
            max-width: 1000px; /* Limita a largura para melhor leitura */
            margin: 20px auto; /* Centraliza o conteúdo */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        /* Estilos para as seções de comida */
        .secao-de-comida {
            margin-bottom: 30px;
            border-bottom: 2px dashed #ccc; /* Linha tracejada para separar */
            padding-bottom: 20px;
            background-color: #F8F8F8;
        }

        /* Estilos para o título da seção */
        .titulo-da-secao {
            color: #ff6347;
            font-size: 2em;
            text-align: center;
            margin-top: 0;
        }

        /* Estilos para a lista de itens do menu */
        .lista-de-itens {
            list-style: none; /* Remove os marcadores de lista */
            padding: 0;
        }

        /* Estilos para cada item da lista */
        .item-do-menu {
            background-color: #fffaf0; /* Fundo creme para o item */
            margin-bottom: 10px;
            padding: 15px;
            border-left: 5px solid #ff6347; /* Destaque lateral */
            display: flex; /* Para alinhar nome e preço */
            justify-content: space-between; /* Espaça nome e preço */
            align-items: center;
        }

        /* Estilos para o nome do prato */
        .nome-do-prato {
            font-weight: bold;
            font-size: 1.2em;
        }

        /* Estilos para o preço */
        .preco-do-prato {
            color: green; /* Cor de dinheiro */
            font-weight: bold;
            font-size: 1.2em;
        }

        /* Estilos para o rodapé */
        .rodape-da-pagina {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.9em;
        }

        /* Estilos para a seção de contato */
        .informacoes-de-contato {
            text-align: center;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <!-- Esta é a parte de cima da página -->
    <div class="cabecalho-da-pagina">
        <h1 class="titulo-principal">Aromá de Vó</h1>
        <p>A melhor comida caseira, feita com amor e carinho!</p>
    </div>

    <!-- Esta é a barra de navegação -->
    <div class="menu-de-navegacao">
        <a href="#menu" class="link-do-menu">Nosso Menu</a>
        <a href="#sobre" class="link-do-menu">Sobre Nós</a>
        <a href="#contato" class="link-do-menu">Fale Conosco</a>
    </div>

    <!-- Esta é a área onde o conteúdo principal fica -->
    <div class="area-de-conteudo">

        <!-- Seção do Menu -->
        <div class="secao-de-comida" id="menu">
            <h2 class="titulo-da-secao">Pratos Principais</h2>
            <ul class="lista-de-itens">
                <li class="item-do-menu">
                    <span class="nome-do-prato">Feijoada Completa (Quarta e Sábado)</span>
                    <span class="preco-do-prato">R$ 35,00</span>
                </li>
                <li class="item-do-menu">
                    <span class="nome-do-prato">Bife Acebolado com Batata Frita e Arroz</span>
                    <span class="preco-do-prato">R$ 28,50</span>
                </li>
                <li class="item-do-menu">
                    <span class="nome-do-prato">Frango Grelhado com Salada Fresca</span>
                    <span class="preco-do-prato">R$ 25,00</span>
                </li>
            </ul>
        </div>

        <div class="secao-de-comida">
            <h2 class="titulo-da-secao">Sobremesas</h2>
            <ul class="lista-de-itens">
                <li class="item-do-menu">
                    <span class="nome-do-prato">Pudim de Leite Condensado</span>
                    <span class="preco-do-prato">R$ 12,00</span>
                </li>
                <li class="item-do-menu">
                    <span class="nome-do-prato">Mousse de Maracujá</span>
                    <span class="preco-do-prato">R$ 10,00</span>
                </li>
            </ul>
        </div>

        <!-- Seção Sobre Nós -->
        <div class="secao-de-comida" id="sobre">
            <h2 class="titulo-da-secao">Nossa História</h2>
            <p>O Sabor da Tradição: Conheça o "Aroma da Vó"
Em uma esquina charmosa, onde o cheiro de tempero caseiro se mistura à brisa da tarde, reside o "Aroma da Vó". Mais do que um restaurante, é um portal para as memórias mais queridas, um refúgio onde cada garfada conta uma história de família e dedicação.
Nossa jornada começou na cozinha de uma matriarca, Dona Aurora, que acreditava que o segredo de qualquer prato reside no tempo e no amor. Ela nos ensinou que não há pressa para a perfeição. Por isso, aqui, o feijão é cozido lentamente, o molho de tomate apura por horas e o pão é assado todas as manhãs, exalando um perfume que convida a entrar.
No "Aroma da Vó", você não encontrará pratos da moda ou invenções efêmeras. Nosso menu é um tributo à culinária brasileira raiz, aquela que conforta a alma. Temos a feijoada de quarta-feira, rica e completa, que atrai clientes de toda a cidade. O bife à parmegiana, com sua crosta crocante e queijo derretido, é um clássico inegável. E para os amantes de sabores mais leves, o frango grelhado com ervas frescas e salada colhida na horta local é a escolha perfeita.
Mas a experiência não se limita ao paladar. O ambiente é acolhedor, com mesas de madeira rústica e paredes adornadas com fotos antigas da família. A trilha sonora é suave, composta por clássicos que embalam a conversa e criam uma atmosfera de tranquilidade. É o lugar ideal para um almoço de negócios descontraído, um encontro romântico ou, simplesmente, para se presentear com uma refeição que abraça.
E não se esqueça das sobremesas! O pudim de leite condensado, com sua calda de caramelo na medida certa, é a assinatura da casa. Cada colherada é um final feliz para a sua refeição.
Venha nos visitar. Deixe-se levar pelo "Aroma da Vó" e descubra o verdadeiro sabor da comida feita com o coração. Estamos abertos de segunda a sábado, esperando para lhe servir não apenas um prato, mas uma dose de felicidade.</p>
        </div>

        <!-- Seção de Contato -->
        <div class="secao-de-comida" id="contato">
            <h2 class="titulo-da-secao">Como Pedir</h2>
            <div class="informacoes-de-contato">
                <ul class="lista-de-contato">
                    <li class="item-contato"><span><strong>Telefone para Pedidos:</strong></span><span>(99) 99999-9999</span></li>
                    <li class="item-contato"><span><strong>Horário de Funcionamento:</strong></span><span>Segunda a Sexta: 11:00h às 15:00h</span></li>
                    <li class="item-contato"><span><strong>Sábados:</strong></span><span>11:00h às 14:00h</span></li>
                    <li class="item-contato"><span><strong>Domingos e Feriados:</strong></span><span>Fechado</span></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- rodapé da pagina -->
    <div class="rodape-da-pagina">
        <p>&copy; Aroma de Vó. Todos os direitos reservados.</p>
    </div>

</body>
</html>