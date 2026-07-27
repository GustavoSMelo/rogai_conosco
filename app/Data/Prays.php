<?php

namespace App\Data;

class Prays
{
    public static function getPrays()
    {
        return [
            "catholic" => [
                [
                    "title" => "Pai Nosso",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Pai nosso que estais nos céus, santificado seja o vosso nome; venha a nós o vosso reino; seja feita a vossa vontade, assim na terra como no céu. O pão nosso de cada dia nos dai hoje; perdoai-nos as nossas ofensas, assim como nós perdoamos a quem nos tem ofendido; e não nos deixeis cair em tentação, mas livrai-nos do mal. Amém.",
                ],
                [
                    "title" => "Ave Maria",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "intercessao"],
                    "body" =>
                        "Ave Maria, cheia de graça, o Senhor é convosco; bendita sois vós entre as mulheres, e bendito é o fruto do vosso ventre, Jesus. Santa Maria, Mãe de Deus, rogai por nós, pecadores, agora e na hora da nossa morte. Amém.",
                ],
                [
                    "title" => "Glória ao Pai",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Glória ao Pai, e ao Filho, e ao Espírito Santo. Como era no princípio, agora e sempre, por todos os séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Santo Anjo do Senhor",
                    "category" => "protecao",
                    "subcategory" => ["anjo_da_guarda", "protecao"],
                    "body" =>
                        "Santo Anjo do Senhor, meu zeloso guardador, se a ti me confiou a piedade divina, sempre me rege, guarda, governa e ilumina. Amém.",
                ],
                [
                    "title" => "Salve Rainha",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "intercessao"],
                    "body" =>
                        "Salve Rainha, Mãe de misericórdia, vida, doçura e esperança nossa, salve! A vós bradamos, os degredados filhos de Eva. A vós suspiramos, gemendo e chorando neste vale de lágrimas. Eia, pois, advogada nossa, esses vossos olhos misericordiosos a nós volvei. E, depois deste desterro, mostrai-nos Jesus, bendito fruto do vosso ventre. Ó clemente, ó piedosa, ó doce e sempre Virgem Maria. Rogai por nós, Santa Mãe de Deus, para que sejamos dignos das promessas de Cristo. Amém.",
                ],
                [
                    "title" => "Credo Apostólico",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Creio em Deus Pai todo-poderoso, criador do céu e da terra. E em Jesus Cristo, seu único Filho, nosso Senhor, que foi concebido pelo poder do Espírito Santo, nasceu da Virgem Maria, padeceu sob Pôncio Pilatos, foi crucificado, morto e sepultado. Desceu à mansão dos mortos, ressuscitou ao terceiro dia, subiu aos céus, está sentado à direita de Deus Pai todo-poderoso, donde há de vir a julgar os vivos e os mortos. Creio no Espírito Santo, na Santa Igreja Católica, na comunhão dos santos, na remissão dos pecados, na ressurreição da carne, na vida eterna. Amém.",
                ],
                [
                    "title" => "Ato de Contrição",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Meu Deus, eu me arrependo de todo o coração de vos ter ofendido. Pesa-me, Senhor, por ter pecado, porque ofendi a vós, que sois o meu sumo bem e digno de ser amado sobre todas as coisas. Proponho firmemente, com o auxílio da vossa graça, não mais pecar e fugir de todas as ocasiões de pecado. Amém.",
                ],
                [
                    "title" => "Oração ao Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "santificacao"],
                    "body" =>
                        "Vinde, Espírito Santo, enchei os corações dos vossos fiéis e acendei neles o fogo do vosso amor. Enviai o vosso Espírito e tudo será criado, e renovareis a face da terra. Oremos: Ó Deus, que instruístes os corações dos vossos fiéis com a luz do Espírito Santo, fazei que apreciemos retamente todas as coisas segundo o mesmo Espírito e gozemos sempre da sua divina consolação. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oferecimento do Dia",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Ó Senhor Deus, criador do céu e da terra, eu vos ofereço este novo dia. Todas as minhas orações, obras, sofrimentos e alegrias, em união com o Sacrifício de Jesus Cristo na Santa Missa. Que tudo seja para vossa glória e para a salvação das almas. Amém.",
                ],
                [
                    "title" => "Angelus",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "fe"],
                    "body" =>
                        "O anjo do Senhor anunciou a Maria, e ela concebeu do Espírito Santo. Ave Maria... Eis aqui a serva do Senhor, faça-se em mim segundo a vossa palavra. Ave Maria... E o Verbo se fez carne e habitou entre nós. Ave Maria... Rogai por nós, Santa Mãe de Deus, para que sejamos dignos das promessas de Cristo. Amém.",
                ],
                [
                    "title" => "Magnificat",
                    "category" => "amor",
                    "subcategory" => ["virgem_maria", "adoracao"],
                    "body" =>
                        "A minha alma engrandece ao Senhor, e o meu espírito se alegra em Deus, meu Salvador, porque olhou para a humildade de sua serva. Desde agora me chamarão bem-aventurada todas as gerações, porque o Poderoso fez em mim grandes coisas. Santo é o seu nome, e a sua misericórdia se estende de geração em geração sobre os que o temem.",
                ],
                [
                    "title" => "Oração de São Francisco",
                    "category" => "fe",
                    "subcategory" => ["fe", "paz"],
                    "body" =>
                        "Senhor, fazei-me instrumento de vossa paz. Onde houver ódio, que eu leve o amor. Onde houver ofensa, que eu leve o perdão. Onde houver discórdia, que eu leve a união. Onde houver dúvida, que eu leve a fé. Onde houver erro, que eu leve a verdade. Onde houver desespero, que eu leve a esperança. Onde houver tristeza, que eu leve a alegria. Onde houver trevas, que eu leve a luz. Ó Mestre, fazei que eu procure mais consolar que ser consolado, compreender que ser compreendido, amar que ser amado. Pois é dando que se recebe, é perdoando que se é perdoado, e é morrendo que se vive para a vida eterna.",
                ],
                [
                    "title" => "Oração a São Miguel Arcanjo",
                    "category" => "protecao",
                    "subcategory" => ["batalha_espiritual", "protecao"],
                    "body" =>
                        "São Miguel Arcanjo, defendei-nos no combate; sede o nosso amparo contra a maldade e as ciladas do demônio. Que Deus manifeste o seu poder sobre ele, e vós, príncipe da milícia celeste, pelo poder divino, precipitai no inferno a Satanás e aos outros espíritos malignos que andam pelo mundo para perder as almas. Amém.",
                ],
                [
                    "title" => "Oração a Nossa Senhora Aparecida",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "intercessao"],
                    "body" =>
                        "Ó Nossa Senhora Aparecida, Rainha e Padroeira do Brasil, olhai com carinho para o vosso povo. Cobri-nos com vosso manto sagrado e protegei-nos de todo o mal. Intercedei por nós junto a vosso Filho Jesus, para que tenhamos paz, saúde e prosperidade. Nossa Senhora Aparecida, rogai por nós. Amém.",
                ],
                [
                    "title" => "Oração a São José",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "São José, homem justo e fiel servo de Deus, que tivestes a honra de criar e proteger o Menino Jesus e a Virgem Maria, protegei as nossas famílias com vosso zelo paternal. Guiai-nos no caminho do trabalho digno e da vida virtuosa. São José, rogai por nós. Amém.",
                ],
                [
                    "title" => "Oração da Manhã",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, agradeço-vos por esta nova manhã. Ofereço-vos todo o meu dia, minhas ações, meus pensamentos e sentimentos. Iluminai minha mente e fortalecei minha vontade para que eu faça o bem e evite o mal. Que eu veja o vosso rosto em cada pessoa que encontrar. Amém.",
                ],
                [
                    "title" => "Oração da Noite",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "Senhor Deus, ao final deste dia, eu vos agradeço por todas as graças recebidas. Perdoai-me pelos erros que cometi e pelas oportunidades de amor que desperdicei. Protegei-me durante a noite e concedei-me um sono tranquilo. Em vossas mãos entrego o meu espírito. Amém.",
                ],
                [
                    "title" => "Oração pelos Enfermos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "cura"],
                    "body" =>
                        "Senhor Jesus, médico das almas e dos corpos, olhai com amor para todos os que sofrem com a doença. Concedei-lhes força, paciência e esperança. Iluminai os profissionais de saúde para que cuidem com sabedoria e compaixão. Que os enfermos sintam a vossa presença consoladora. Amém.",
                ],
                [
                    "title" => "Oração pela Paz",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor Deus, Príncipe da Paz, derramai vosso Espírito de amor sobre o mundo inteiro. Tocai o coração dos líderes das nações para que busquem a reconciliação e o bem comum. Afastai de nós a violência e o ódio, e fazei de nós instrumentos da vossa paz. Amém.",
                ],
                [
                    "title" => "Oração pelas Almas do Purgatório",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Senhor Deus, concedei o descanso eterno a todas as almas que partiram desta vida na vossa graça. Purificai-as com vossa misericórdia e acolhei-as na luz eterna da vossa presença. Pelos méritos de Cristo e pela intercessão da Virgem Maria e de todos os santos, dai-lhes a paz que não tem fim. Amém.",
                ],
                [
                    "title" => "Oração antes das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Abençoai, Senhor, estes alimentos que vamos receber da vossa bondade. Dai pão a quem tem fome e fome de justiça a quem tem pão. Por Cristo, nosso Senhor. Amém.",
                ],
                [
                    "title" => "Terço da Misericórdia",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Eterno Pai, eu vos ofereço o Corpo e Sangue, Alma e Divindade de vosso diletíssimo Filho, Nosso Senhor Jesus Cristo, em expiação dos nossos pecados e do mundo inteiro. Pela sua dolorosa Paixão, tende misericórdia de nós e do mundo inteiro. Ó Deus Santo, Deus Forte, Deus Imortal, tende piedade de nós e do mundo inteiro. Amém.",
                ],
                [
                    "title" => "Oração ao Sagrado Coração de Jesus",
                    "category" => "amor",
                    "subcategory" => ["amor", "adoracao"],
                    "body" =>
                        "Sagrado Coração de Jesus, em vós confio. Coração de Jesus, fonte de toda consolação, tende piedade de nós. Coração de Jesus, cheio de bondade e amor, fazei com que o nosso coração se assemelhe ao vosso. Amém.",
                ],
                [
                    "title" => "Oferecimento do Trabalho",
                    "category" => "fe",
                    "subcategory" => ["fe", "trabalho"],
                    "body" =>
                        "Senhor, ofereço-vos o meu trabalho de hoje. Que cada tarefa seja feita com amor e dedicação, para vossa glória e para o bem do próximo. Abençoai meus colegas e superiores, e fazei de mim um instrumento de paz e colaboração. Amém.",
                ],
                [
                    "title" => "Oração pela Família",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Deus, abençoai e protegei a minha família. Que o vosso amor seja o alicerce do nosso lar. Dai-nos paciência, compreensão e perdão uns para com os outros. Santificai a nossa convivência e guiai-nos pelo caminho da paz. Amém.",
                ],
                [
                    "title" => "Oração de Louvor",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Bendito sejais, Senhor Deus do universo, por vossa infinita bondade e misericórdia. Louvado sejais pelo sol e pela lua, pelas estrelas e pelo mar. Louvado sejais por cada sopro de vida. Cantarei eternamente as vossas maravilhas e anunciarei o vosso amor. Amém.",
                ],
                [
                    "title" => "Oração de Agradecimento",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, de todo o coração vos agradeço por tantas bênçãos que generosamente me concedeis. Agradeço pela vida, pela fé, pela família e pelos amigos. Agradeço pelos desafios que me fazem crescer e pelas alegrias que iluminam meus dias. Obrigado, Senhor, porque tudo é dom vosso. Amém.",
                ],
                [
                    "title" => "Oração de Santo Antônio",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Glorioso Santo Antônio, que tivestes o privilégio de segurar o Menino Jesus em vossos braços, intercedei por nós junto a Deus. Ajudai-nos a encontrar o que foi perdido: encontrai a paz em nossos lares, a fé em nossos corações e a esperança em nossas vidas. Santo Antônio, rogai por nós. Amém.",
                ],
                [
                    "title" => "Oração de Santa Terezinha",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Santa Terezinha do Menino Jesus, que fizestes da simplicidade e do amor o vosso caminho de santidade, ensinai-nos a confiar em Deus como uma criança confia em seu pai. Ajudai-nos a encontrar Deus nas pequenas coisas de cada dia. Santa Terezinha, rogai por nós. Amém.",
                ],
                [
                    "title" => "Oração a Nossa Senhora de Fátima",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "intercessao"],
                    "body" =>
                        "Ó Nossa Senhora do Rosário de Fátima, que aparecestes aos pastorinhos e pedistes oração e penitência pela conversão dos pecadores, ajudai-nos a viver o Evangelho com simplicidade e coragem. Ensinai-nos a rezar o terço com devoção e a oferecer sacrifícios com amor. Amém.",
                ],
                [
                    "title" => "Ofício da Imaculada Conceição",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "fe"],
                    "body" =>
                        "Ó Deus, que pela Imaculada Conceição da Virgem Maria preparastes uma digna habitação para o vosso Filho, concedei-nos que, pela intercessão dela, cheguemos puros de coração à vossa presença. Por Cristo, nosso Senhor. Amém.",
                ],
                [
                    "title" => "A Cruz Sagrada seja a minha luz",
                    "category" => "protecao",
                    "subcategory" => ["batalha_espiritual", "fe"],
                    "body" =>
                        "A Cruz Sagrada seja a minha luz, não seja o dragão o meu guia. Retira-te, satanás! Nunca me aconselhes coisas vãs. É mau o que tu me ofereces. Bebe tu mesmo os teus venenos!",
                ],
                [
                    "title" => "Oração ao Anjo da Guarda",
                    "category" => "protecao",
                    "subcategory" => ["anjo_da_guarda", "intercessao"],
                    "body" =>
                        "Ó Espírito angélico, a cujos próvidos cuidados entregou-me Deus, Nosso Senhor, rogo-vos que sempre queirais guardar-me e proteger-me, assistir-me e defender-me de todo assalto do demônio, quer eu esteja acordado, quer dormindo. Oh! sim, assisti-me noite e dia, a todo momento; estai sempre ao meu lado onde quer que eu me ache. Afastai para longe de mim todas as tentações de Satanás e obtende-me do misericordiosíssimo Juiz e Senhor nosso a graça de permanecer imune de toda culpa em minha vida.",
                ],
                [
                    "title" => "Oração aos Anjos e Arcanjos",
                    "category" => "santificacao",
                    "subcategory" => ["pureza", "intercessao", "protecao"],
                    "body" =>
                        "É a vossa benignidade que rogo e imploro, ó bons e imaculados Anjos e Arcanjos! A vosso poder recorro, ó intemeratos espíritos! Obtende-me que pura seja a minha vida; inabalável, a minha esperança; ilibados, os meus costumes; perfeito e livre de toda ofensa, o meu amor para com Deus e para com o próximo. Ah! tomai-me pela mão, conduzi-me, guiai-me por aqueles caminhos que são aceitos por Deus e salutares para mim.",
                ],
                [
                    "title" => "Protesto do Santo Anjo na hora da morte",
                    "category" => "esperanca",
                    "subcategory" => ["boa_morte", "fe", "protecao"],
                    "body" =>
                        "Em nome da SS. Trindade, Pai, Filho e Espírito Santo, eu, infeliz e miserável pecador, protesto em vossa presença, ó Anjo Santo de Deus, que quero absolutamente morrer na Igreja Católica, Apostólica e Romana, na qual morreram todos os santos que até agora existiram e fora da qual não há salvação. Assisti-me na hora da morte e fazei-me vencer o demônio, inimigo meu e vosso.",
                ],
                [
                    "title" => "Oração ao Santo Anjo Protetor",
                    "category" => "protecao",
                    "subcategory" => ["anjo_da_guarda", "fe"],
                    "body" =>
                        "Anjo santo, amado de Deus, que por divina disposição tomastes-me sob a vossa bem-aventurada guarda desde o primeiro instante de minha vida, jamais cesseis de defender-me, de iluminar-me, de reger-me. Venero-vos como padroeiro, amo-vos como guarda, submeto-me à vossa direção e todo me dou a vós, para ser por vós governado.",
                ],
                [
                    "title" => "Senhor Jesus Cristo, Filho de Deus",
                    "category" => "arrependimento",
                    "subcategory" => ["perdao", "fe", "santificacao"],
                    "body" =>
                        "Senhor Jesus Cristo, Filho de Deus, tende piedade de mim pois sou um pecador.",
                ],
                [
                    "title" =>
                        "Oração de São Tomás de Aquino antes dos estudos",
                    "category" => "estudos",
                    "subcategory" => ["sabedoria", "espirito_santo", "fe"],
                    "body" =>
                        "Infalível Criador, que, dos tesouros da Vossa sabedoria, tirastes as hierarquias dos anjos, colocando-as com ordem admirável no céu; Vós, que distribuístes o universo com encantadora harmonia; Vós, que sois a verdadeira fonte da luz e o princípio supremo da sabedoria, difundi sobre as trevas da minha mente o raio do esplendor, removendo as duplas trevas nas quais nasci: o pecado e a ignorância.",
                ],
                [
                    "title" => "Invocação ao Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "fe", "amor"],
                    "body" =>
                        "Inspirai em mim, Espírito Santo, para que os meus pensamentos sejam todos santos. Atrai o meu coração, Espírito Santo, que eu ame apenas o que é sagrado. Fortalece-me, Espírito Santo, para defender tudo o que é sagrado. Guarda-me, pois, ó Espírito Santo, para que eu seja sempre santo.",
                ],
                [
                    "title" => "Oração a Jesus Cristo",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe", "entrega"],
                    "body" =>
                        "Vós sois, ó Jesus, o Cristo, meu Pai santo, meu Deus misericordioso, meu Rei infinitamente grande. Sois meu bom pastor, meu único mestre, meu auxílio cheio de bondade. Minha verdadeira luz, minha santa doçura, meu reto caminho. Que, a partir deste momento, meu coração só deseje a vós e por vós se inflame.",
                ],
                [
                    "title" => "Tomai, Senhor, e recebei",
                    "category" => "fe",
                    "subcategory" => ["entrega", "amor", "santificacao"],
                    "body" =>
                        "Tomai, Senhor, e recebei toda a minha liberdade e a minha memória também. O meu entendimento e toda a minha vontade, tudo o que tenho e possuo vós me destes com amor. Todos os dons que me destes com gratidão vos devolvo. Disponde deles, Senhor, segundo a vossa vontade. Dai-me somente o vosso amor, vossa graça. Isto me basta, nada mais quero pedir.",
                ],
                [
                    "title" => "Oração a Santa Rita de Cássia",
                    "category" => "esperanca",
                    "subcategory" => ["intercessao", "casos_impossiveis", "fe"],
                    "body" =>
                        "Ó Poderosa e gloriosa Santa Rita, eis a vossos pés uma alma desamparada que, necessitando de auxílio, a vós recorre com a doce esperança de ser atendida por vós, que tem o título de santa dos casos impossíveis e desesperados. Ó cara santa, interessai-vos pela minha causa, intercedei junto a Deus para que me conceda a graça de que tanto necessito. Santa Rita, Advogada dos Impossíveis, rogai por nós!",
                ],
                [
                    "title" => "Oração a Santa Teresinha do Menino Jesus",
                    "category" => "intercessao",
                    "subcategory" => ["amor", "humildade", "fe"],
                    "body" =>
                        "Ó, Santa Teresinha do Menino Jesus, modelo de humildade, de confiança e de amor! Do alto dos céus, despeje sobre nós estas rosas que levas em teus braços: a rosa da humildade para que vençamos nosso orgulho e aceitemos o jugo do Evangelho; a rosa da confiança para que nos abandonemos à vontade de Deus e descansemos em Sua Misericórdia; a rosa do amor para que, abrindo nossas almas sem medida à graça, realizemos o único fim para o qual Deus nos criou à sua imagem: amar-Lhe e fazer-Lhe amar.",
                ],
                [
                    "title" => "Oração de São Jorge",
                    "category" => "protecao",
                    "subcategory" => ["fe", "libertacao", "batalha_espiritual"],
                    "body" =>
                        "Eu andarei vestido e armado com as armas de São Jorge, para que meus inimigos, tendo pés não me alcancem, tendo mãos não me peguem, tendo olhos não me vejam, e nem em pensamentos eles possam me fazer mal. Armas de fogo o meu corpo não alcançarão, facas e lanças se quebram sem o meu corpo tocar, cordas e correntes se arrebentem sem o meu corpo amarram. Jesus Cristo, me proteja e me defenda com o poder da sua santa e divina graça.",
                ],
                [
                    "title" => "Oração a São Pedro Apóstolo",
                    "category" => "fe",
                    "subcategory" => ["intercessao", "igreja", "apostolos"],
                    "body" =>
                        "Ó glorioso São Pedro, Príncipe dos Apóstolos, a quem o SENHOR JESUS escolheu para ser o fundamento da Igreja, entregou as chaves do Reino dos Céus e constituiu Pastor universal dos fiéis, queremos ser sempre vossos súditos e filhos. Confiantes na Palavra do SENHOR, concedei-nos a graça de professar com firmeza a nossa fé em CRISTO, Filho de Deus.",
                ],
                [
                    "title" => "Oração do Médico",
                    "category" => "saude",
                    "subcategory" => ["trabalho", "servico", "fe"],
                    "body" =>
                        "Ó Mestre, Eu te agradeço porque me entregaste a missão de exercer a medicina, restituir a alegria de viver às pessoas que me são confiadas a qualquer hora, momento e lugar. Ofereço-te a minha vocação de servir a sociedade como instrumento de tua providência. Grandes são os avanços da ciência, mas também são inúmeros os desafios à limitação humana que exige de mim seriedade, equilíbrio, sabedoria e fidelidade ao juramento que fiz.",
                ],
                [
                    "title" => "Oração a São Tiago Apóstolo",
                    "category" => "fe",
                    "subcategory" => [
                        "intercessao",
                        "peregrinacao",
                        "esperanca",
                    ],
                    "body" =>
                        "Apóstolo São Tiago, escolhido entre os primeiros, tu foste o primeiro a beber no cálice do Senhor, e és o grande protetor dos peregrinos; faz-nos fortes na fé e alegres na esperança, em nosso caminhar de peregrino seguindo o caminho da vida de Cristo e alenta-nos para que finalmente alcancemos a glória de Deus Pai. Que assim seja. Amém.",
                ],
                [
                    "title" => "Oração a São João Batista",
                    "category" => "santificacao",
                    "subcategory" => ["penitencia", "pureza", "intercessao"],
                    "body" =>
                        "Ó glorioso São João Batista, profeta e precursor do Altíssimo, ajudai-me a acolher a Boa Nova que anunciastes. Quero fazer de minha existência uma realização da justiça, do amor, da penitência e da pureza que proclamastes. Alcançai-me a graça de pertencer inteiramente ao Reino por vós prenunciado e que está presente entre nós, desde o nascimento de Jesus.",
                ],
                [
                    "title" => "Oração a São João Apóstolo",
                    "category" => "amor",
                    "subcategory" => ["intercessao", "apostolos", "fe"],
                    "body" =>
                        "Ó, Apóstolo, orador da divindade, pela grandeza de vossa vida e pelos dons que recebestes, sem cessar, intercedei por nós diante do Pai, do Filho e do Espírito Santo, agora e sempre. São João, discípulo amado que reclinou a cabeça sobre o peito do Mestre na Santa Ceia e permaneceu firme ao pé da Cruz, ensina-nos a viver no amor do Senhor.",
                ],
                [
                    "title" =>
                        "Memorare — Lembrai-vos, ó piedosíssima Virgem Maria",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "fe", "esperanca"],
                    "body" =>
                        "Lembrai-vos, ó piedosíssima Virgem Maria, que nunca se ouviu dizer que algum daqueles que a vós têm recorrido, implorado a vossa assistência e invocado o vosso auxílio fosse por vós desamparado. Animado eu, pois, por igual confiança, a vós recorro, ó Mãe, Virgem das virgens; a vós venho; aos vossos pés, gemendo, pecador me prostro. Não desprezeis as minhas súplicas, ó Mãe do Verbo encarnado; mas ouvi-as propícia e atendei-as. Amém.",
                ],
                [
                    "title" =>
                        "Sequência de Pentecostes — Vinde, Santo Espírito",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "fe", "esperanca"],
                    "body" =>
                        "Vinde, Santo Espírito, e enviai do céu um raio da vossa luz. Vinde, pai dos pobres; vinde, doador dos dons; vinde, luz dos corações. Consolador ótimo, doce hóspede da alma, doce refrigério. No trabalho, descanso; no ardor, frescor; no pranto, consolo. Ó luz beatíssima, enchei o íntimo do coração dos vossos fiéis. Sem a vossa força, nada há no homem, nada há inocente. Lavai o que é sujo, regai o que é árido, curai o que está ferido. Dobrai o que é rígido, aquecei o que é frio, reconduzi o desviado. Dai aos vossos fiéis, que em vós confiam, os sete dons sagrados. Dai o mérito da virtude, dai o êxito da salvação, dai a perene alegria. Amém.",
                ],
                [
                    "title" => "Oração pelos enfermos",
                    "category" => "saude",
                    "subcategory" => ["cura", "intercessao", "esperanca"],
                    "body" =>
                        "Deus, singular proteção da debilidade humana, mostrai a força do vosso auxílio sobre os vossos servos doentes, para que, ajudados por vossa misericórdia, mereçam apresentar-se incólumes aos olhos da vossa santa Igreja. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração pela recuperação da saúde",
                    "category" => "cura",
                    "subcategory" => ["saude", "fe", "intercessao"],
                    "body" =>
                        "Deus eterno e todo-poderoso, salvação eterna dos que creem: ouvi nossas preces pelos vossos servos doentes, para os quais imploramos o auxílio da vossa misericórdia; a fim de que, havendo recuperado a saúde, vos rendam graças na vossa Igreja. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração pela Igreja perseguida",
                    "category" => "protecao",
                    "subcategory" => ["igreja", "fe", "paz"],
                    "body" =>
                        "Dai à vossa Igreja, nós vos pedimos, Deus de misericórdia, que, reunida no Espírito Santo, de modo algum seja perturbada por perseguições hostis. Sufocai, Senhor, a soberba dos nossos inimigos, e com a força do vosso braço prostrai-lhes a obstinação. Não desprezeis, Deus todo-poderoso, o vosso povo, que a vós clama aflito; mas, pela glória do vosso nome, socorrei de rosto sereno os atribulados. Por Nosso Senhor Jesus Cristo, vosso Filho, que convosco vive e reina pelos séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Oração pela pureza do coração",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "pureza", "castidade"],
                    "body" =>
                        "Purificai, Senhor, com o fogo do Espírito Santo os nossos rins e o nosso coração, para que vos sirvamos de corpo casto e de coração puro vos sejamos gratos. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração pela pureza com a Virgem Maria",
                    "category" => "santificacao",
                    "subcategory" => ["virgem_maria", "pureza", "intercessao"],
                    "body" =>
                        "Por vossa imaculada conceição e perpétua virgindade, ó puríssima Virgem Maria, purificai o meu coração e a minha carne. Tornai, Senhor, o meu coração imaculado, para que eu não seja confundido!, ou: Purificai o meu coração e o meu corpo, santa Maria!",
                ],
                [
                    "title" => "Oração ao Coração de Maria",
                    "category" => "santificacao",
                    "subcategory" => ["virgem_maria", "pureza", "intercessao"],
                    "body" =>
                        "Dai-nos, Deus eterno e todo-poderoso, alcançar pela inviolável virgindade da puríssima Virgem Maria pureza de mente e de corpo. Amém. Coração de Maria, refúgio dos pecadores, rogai por nós que recorremos a vós!",
                ],
                [
                    "title" => "Oração pela perseverança nas adversidades",
                    "category" => "forca",
                    "subcategory" => ["fe", "esperanca", "santificacao"],
                    "body" =>
                        "Ó Deus, que pela paciência do vosso Unigênito esmagastes a soberba do antigo inimigo, dai-nos, vo-lo pedimos, recordar dignamente o que ele por nós padeceu e assim, a seu exemplo, tolerar de ânimo igual nossas adversidades. Pelo mesmo Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração contra as tentações",
                    "category" => "santificacao",
                    "subcategory" => ["amor", "fe", "perseveranca"],
                    "body" =>
                        "Deus, que tudo fazeis concorrer para o bem dos que vos amam, dai a nossos corações o inviolável afeto de vossa caridade, de modo que tentação alguma altere os desejos que nos inspirais. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração pelas virtudes teologais",
                    "category" => "santificacao",
                    "subcategory" => ["fe", "esperanca", "amor"],
                    "body" =>
                        "Deus eterno e todo-poderoso, aumentai em nós a fé, a esperança e a caridade, e, para merecermos alcançar o que prometeis, fazei-nos amar o que ordenais. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração de Purificação pelo Espírito Santo",
                    "category" => "arrependimento",
                    "subcategory" => [
                        "perdao",
                        "espirito_santo",
                        "santificacao",
                    ],
                    "body" =>
                        "Infundi clemente em nossos corações, Senhor Deus, a graça do Espírito Santo, a qual nos purifique, com gemidos e lágrimas, das manchas dos nossos pecados e nos alcance, por vossa liberalidade, o efeito do tão almejado perdão. Por Cristo, Senhor nosso. Amém.",
                ],
                [
                    "title" => "Oração antes da Comunhão",
                    "category" => "santificacao",
                    "subcategory" => ["eucaristia", "fe", "arrependimento"],
                    "body" =>
                        "Senhor Jesus Cristo, Filho do Deus vivo, que, obediente à vontade do Pai, com a cooperação do Espírito Santo, por vossa morte vivificastes o mundo, livrai-me de todas as minhas iniquidades e de todos os males; fazei-me observar sempre os vossos mandamentos, e nunca permitais que me separe de vós. Vós, que sois Deus e com o Pai e Espírito Santo viveis e reinais pelos séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Cordeiro de Deus",
                    "category" => "arrependimento",
                    "subcategory" => ["perdao", "paz", "eucaristia"],
                    "body" =>
                        "Cordeiro de Deus, que tirais o pecado do mundo, tende piedade de nós. Cordeiro de Deus, que tirais o pecado do mundo, tende piedade de nós. Cordeiro de Deus, que tirais o pecado do mundo, dai-nos a paz.",
                ],
                [
                    "title" => "Consagração ao Sagrado Coração de Jesus",
                    "category" => "fe",
                    "subcategory" => ["amor", "consagracao", "igreja"],
                    "body" =>
                        "Jesus dulcíssimo, redentor do gênero humano, vede-nos diante do vosso altar, humildemente prostrados. Vossos somos, vossos queremos ser, e a fim de podermos estar mais firmemente unidos a vós, eis que cada um de nós hoje se consagra espontaneamente ao vosso sacratíssimo Coração.",
                ],
                [
                    "title" =>
                        "Consagração do gênero humano ao Sagrado Coração de Jesus",
                    "category" => "fe",
                    "subcategory" => ["amor", "intercessao", "paz"],
                    "body" =>
                        "Muitos há que nunca vos conheceram; muitos, desprezando os vossos mandamentos, vos têm repudiado. Tende piedade duns e doutros, benigníssimo Jesus, e atraí-os todos para o vosso santo Coração. Sede rei, Senhor, não somente dos fiéis que nunca se afastaram de vós, mas também dos filhos pródigos que vos abandonaram; fazei-os tornar quanto antes à casa paterna.",
                ],
                [
                    "title" => "Oração de aceitação da morte",
                    "category" => "esperanca",
                    "subcategory" => ["boa_morte", "fe", "entrega"],
                    "body" =>
                        "Senhor Deus meu, desde já aceito de vossas mãos, com ânimo sereno e alegre, qualquer gênero de morte que vos aprouver, com todas as suas angústias, penas e dores.",
                ],
                [
                    "title" => "Santa Cruz, única esperança",
                    "category" => "protecao",
                    "subcategory" => ["fe", "esperanca", "salvacao"],
                    "body" =>
                        "Ó Cruz, certeza de salvação. Ó Cruz, à qual sempre adoro. Ó Cruz do Senhor, que estás sempre comigo. Ó Cruz, na qual me refugio. Salve, ó cruz, única esperança! Pelo sinal da santa cruz, livrai-nos, Deus nosso Senhor, dos nossos inimigos.",
                ],
                [
                    "title" => "Oração de entrega à vontade de Deus",
                    "category" => "fe",
                    "subcategory" => ["entrega", "amor", "confianca"],
                    "body" =>
                        "Tomai, Senhor, e recebei toda a minha liberdade, a minha memória, o meu entendimento e toda a minha vontade. Tudo o que tenho e possuo, de vós o recebi; por isso a vós, Senhor, o entrego e restituo, para que disponhais de tudo segundo a vossa vontade. Concedei-me somente o vosso amor e a vossa graça, que isto me basta, e não desejo outra coisa da vossa misericórdia infinita. Amém.",
                ],
            ],
            "protestant" => [
                [
                    "title" => "Oração de Gratidão",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, agradeço-te por este dia e por todas as tuas bênçãos. Obrigado pelo teu amor incondicional e pela tua graça que se renova a cada manhã. Entrego em tuas mãos as minhas preocupações e confio que tu cuidas de mim. Que o meu coração permaneça grato em todo o tempo. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Paz",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor, dá-me a paz que excede todo o entendimento. Ajuda-me a confiar em ti nos momentos de ansiedade e incerteza. Lembra-me que tu estás no controle de todas as coisas e que os teus planos para mim são de bem e não de mal. Entrego a ti o meu espírito. Amém.",
                ],
                [
                    "title" => "Pai Nosso",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Pai nosso que estás nos céus, santificado seja o teu nome. Venha o teu reino, seja feita a tua vontade, assim na terra como no céu. O pão nosso de cada dia nos dá hoje. Perdoa as nossas dívidas, assim como nós perdoamos aos nossos devedores. E não nos deixes cair em tentação, mas livra-nos do mal. Teu é o reino, o poder e a glória para sempre. Amém.",
                ],
                [
                    "title" => "Oração de Jabez",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Senhor, abençoa-me abundantemente e alarga as minhas fronteiras. Que a tua mão esteja comigo e me guardes do mal, para que eu não sofra aflição. Atende este clamor e derrama sobre mim a tua graça. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração da Manhã",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Bom dia, Senhor! Entrego a ti esta manhã e todo este dia. Guia os meus passos, guarda os meus pensamentos e dirige as minhas palavras. Que eu seja luz onde houver trevas e sal onde houver sabor. Usa-me para a tua glória neste dia. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração da Noite",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "Senhor, ao encerrar este dia, eu te agradeço por cada momento vivido. Perdoa-me onde pequei e onde deixei de amar. Cura as feridas e renova as minhas forças. Em paz me deito e logo adormeço, porque só tu, Senhor, me fazes habitar em segurança. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Ação de Graças",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, com todo o meu ser eu te agradeço. Pelas manhãs que se renovam, pelo alimento que me sustenta, pelas pessoas que amo e que me amam. Em tudo dá graças, pois esta é a tua vontade para mim. Obrigado por Tua fidelidade que se renova a cada manhã. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Família",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, abençoa e protege a minha família. Que o teu amor seja o fundamento do nosso lar. Concede-nos paciência, compreensão e perdão. Une-nos em amor e fé. Que cada membro da minha família conheça o teu amor e viva segundo a tua vontade. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Enfermos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "cura"],
                    "body" =>
                        "Senhor Jesus, médico dos médicos, estende a tua mão curadora sobre todos os enfermos. Restaura a saúde dos corpos e a paz das almas. Fortalece os que cuidam e dá esperança aos que sofrem. Creio no teu poder de curar e renovar. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Pátria",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Deus, soberano sobre todas as nações, derrama a tua bênção sobre o nosso país. Concede sabedoria aos nossos governantes, justiça aos nossos legisladores e paz ao nosso povo. Que o Brasil se volte para ti e que a tua vontade seja feita em nossa terra. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Missionários",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor da seara, protege e fortalece os missionários que levaram o evangelho aos confins da terra. Dá-lhes coragem diante dos desafios, sabedoria diante das dificuldades e fervor no coração. Multiplica os frutos do seu trabalho e levanta novos obreiros para a tua messe. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Pastores",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, protege e renova os pastores que apascentam o teu rebanho. Dá-lhes sabedoria para ensinar, coragem para exortar e amor para cuidar. Guarda as suas famílias e renova as suas forças. Que eles sejam exemplo no falar, no proceder e no amor. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Salomão",
                    "category" => "fe",
                    "subcategory" => ["fe", "sabedoria"],
                    "body" =>
                        "Senhor, dá-me sabedoria e conhecimento para governar a minha vida segundo a tua vontade. Concede-me um coração compreensivo para discernir entre o bem e o mal. Como Salomão pediu sabedoria, eu te peço: ensina-me a viver de forma que agrade a ti e abençoe os que estão ao meu redor. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Bênção de Aarão",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "O Senhor te abençoe e te guarde. O Senhor faça resplandecer o seu rosto sobre ti e tenha misericórdia de ti. O Senhor levante sobre ti o seu rosto e te dê a paz. Em nome do Pai, do Filho e do Espírito Santo. Amém.",
                ],
                [
                    "title" => "Salmo 23",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "O Senhor é o meu pastor; nada me faltará. Ele me faz repousar em pastos verdejantes e me guia junto a águas tranquilas. Renova as minhas forças e me conduz por caminhos de justiça por amor do seu nome. Mesmo que eu ande pelo escuro vale da morte, não temerei mal algum, porque tu estás comigo; a tua vara e o teu cajado me protegem.",
                ],
                [
                    "title" => "Salmo 91",
                    "category" => "protecao",
                    "subcategory" => ["protecao", "fe"],
                    "body" =>
                        "Aquele que habita no esconderijo do Altíssimo descansa à sombra do Onipotente. Direi do Senhor: Ele é o meu Deus, o meu refúgio, a minha fortaleza, e nele confiarei. Não te assustarás com o terror da noite, nem com a seta que voa de dia. Porque aos seus anjos dará ordens a teu respeito, para te guardarem em todos os teus caminhos.",
                ],
                [
                    "title" => "Oração de Davi",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Grande és tu, Senhor Deus! Não há ninguém como tu, e não há Deus além de ti. Quem sou eu para que me trouxeste até aqui? Tu me conheces e me abençoas. Que o teu nome seja engrandecido para sempre. Tudo o que temos vem de ti, e do que é teu te damos. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Ana",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Meu coração se alegra no Senhor, minha força é exaltada no meu Deus. Não há santo como o Senhor, não há rocha como o nosso Deus. Ele levanta o pobre do pó e exalta o necessitado. Ele guarda os pés dos seus santos. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Elias",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Senhor Deus de Abraão, Isaque e Israel, faze conhecido hoje que tu és Deus. Responde-me, Senhor, responde-me para que este povo saiba que tu és o Senhor Deus. Não há outro Deus além de ti. Eu confio que tu ouves o clamor dos teus servos e ages em favor daqueles que te amam. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Paulo pelos Efésios",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Dobro os meus joelhos diante do Pai, de quem toda família nos céus e na terra toma nome, para que vos conceda, segundo a riqueza da sua glória, que sejais fortalecidos com poder pelo seu Espírito no homem interior; para que Cristo habite pela fé nos vossos corações, e que, arraigados e fundados em amor, possais compreender a largura, o comprimento, a altura e a profundidade do amor de Cristo. Amém.",
                ],
                [
                    "title" => "Oração Sacerdotal de Jesus",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Pai santo, guarda em teu nome aqueles que me deste, para que sejam um, assim como nós somos um. Não peço que os tires do mundo, mas que os guardes do maligno. Santifica-os na verdade; a tua palavra é a verdade. Para que todos sejam um, assim como tu, ó Pai, estás em mim e eu em ti, que também eles estejam em nós. Amém.",
                ],
                [
                    "title" => "Oração pelo Trabalho",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "trabalho"],
                    "body" =>
                        "Senhor Deus, abençoa o trabalho das minhas mãos. Dá-me sabedoria para realizar minhas tarefas com excelência e integridade. Abre portas de oportunidade e concede-me favor diante das pessoas. Que o meu trabalho seja uma bênção para outros e uma oferta de adoração a ti. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Filhos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, entrego meus filhos em tuas mãos. Protege-os de todo o mal, guia-os pelo caminho da verdade e enche-os do teu Espírito. Dá-lhes sabedoria, saúde e um coração que te ame. Que eles cresçam em graça e conhecimento, e sejam instrumentos teus onde quer que forem. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Confissão",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Senhor Deus, reconheço diante de ti que pequei. Perdoa as minhas transgressões e purifica o meu coração. Cria em mim um coração puro e renova dentro de mim um espírito estável. Não me lances fora da tua presença nem retires de mim o teu Santo Espírito. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelo Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "santificacao"],
                    "body" =>
                        "Vem, Espírito Santo, enche-me da tua presença. Ensina-me todas as coisas e lembra-me das palavras de Jesus. Dá-me poder para testemunhar e dons para servir. Produze em mim o teu fruto: amor, alegria, paz, paciência, bondade, fidelidade, mansidão e domínio próprio. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Intercessão",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, coloco diante de ti as necessidades daqueles que amo. Intercedo por aqueles que estão sofrendo, pelos que estão perdidos, pelos que estão doentes e pelos que estão desanimados. Usa-me como canal da tua bênção. Que a tua vontade seja feita na vida de cada um. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelo Casamento",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Deus, abençoa o meu casamento e fortalece o nosso amor. Ajuda-nos a honrar o compromisso que fizemos diante de ti. Dá-nos paciência, compreensão e perdão mútuo. Que o nosso lar seja um reflexo do teu amor e da tua graça. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Livramento",
                    "category" => "protecao",
                    "subcategory" => ["protecao", "fe"],
                    "body" =>
                        "Senhor, tu és o meu refúgio e a minha fortaleza. Livra-me do mal e protege-me de todo perigo. Guarda-me dos laços do inimigo e sustenta-me com a tua mão poderosa. Não temas, diz o Senhor, porque eu estou contigo. Em ti confio e não temerei. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Provisão",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Deus, tu és Jeová Jireh, o Deus da provisão. Confio que tu suprirás todas as minhas necessidades segundo as tuas riquezas em glória. Ensina-me a ser generoso assim como tu és generoso. Abençoa-me para que eu seja uma bênção. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Consagração",
                    "category" => "fe",
                    "subcategory" => ["fe", "santificacao"],
                    "body" =>
                        "Senhor, apresento o meu corpo como sacrifício vivo, santo e agradável a ti, que é o meu culto racional. Não me conforme com este mundo, mas transforma-me pela renovação da minha mente. Tudo o que sou e tudo o que tenho pertence a ti. Usa-me para a tua glória. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Glória ao Pai",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Glória ao Pai, e ao Filho, e ao Espírito Santo, como era no princípio, agora e sempre, por todos os séculos. Amém.",
                ],
                [
                    "title" => "Oferecimento do Dia",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, eu te ofereço este novo dia. Que cada pensamento, palavra e ação seja para a tua glória. Usa as minhas mãos para servir, a minha mente para aprender e o meu coração para amar. Que eu seja sal e luz neste mundo. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Agradecimento",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor, com todo o meu ser eu te agradeço. Obrigado pela vida que me deste, pela salvação em Jesus Cristo e pelo Espírito Santo que me guia. Agradeço por cada bênção grande e pequena. Que a minha gratidão se expresse em obediência e amor. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Louvor",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Grande és tu, Senhor, e digno de todo louvor! A minha alma te engrandece e o meu espírito se alegra em ti. Cantarei o teu amor para sempre e proclamarei a tua fidelidade a todas as gerações. Não há Deus como tu, ó Senhor. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração antes das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, abençoa este alimento que vamos receber. Assim como sustentas o nosso corpo, alimenta também a nossa alma com a tua palavra. Lembra-nos dos que têm fome e ajuda-nos a compartilhar com generosidade. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Paz",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor Jesus, Príncipe da Paz, derrama a tua paz sobre o mundo. Acalma os corações aflitos, reconcilia os que estão em conflito e ensina-nos a viver em unidade. Que a tua paz, que excede todo o entendimento, guarde os nossos corações. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Enfermos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "cura"],
                    "body" =>
                        "Pai de amor, estende a tua mão curadora sobre todos os enfermos. Restaura a saúde dos corpos e a paz das almas. Fortalece os que cuidam e dá esperança aos que sofrem. Nada é impossível para ti. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Família",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, protege e abençoa as nossas famílias. Que o teu amor seja o fundamento de cada lar. Concede-nos paciência, perdão e compreensão mútua. Ensina-nos a amar como Cristo amou a igreja. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de São Francisco",
                    "category" => "fe",
                    "subcategory" => ["fe", "paz"],
                    "body" =>
                        "Senhor, fazei-me instrumento da vossa paz. Onde houver ódio, que eu leve o amor; onde houver ofensa, que eu leve o perdão; onde houver discórdia, que eu leve a união; onde houver dúvida, que eu leve a fé; onde houver desespero, que eu leve a esperança; onde houver trevas, que eu leve a luz. Porque é dando que se recebe, é perdoando que se é perdoado. Amém.",
                ],
                [
                    "title" => "Magnificat",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "A minha alma engrandece ao Senhor, e o meu espírito se alegra em Deus, meu Salvador, porque olhou para a humildade da sua serva. Desde agora me chamarão bem-aventurada todas as gerações, porque o Poderoso fez em mim grandes coisas. Santo é o seu nome, e a sua misericórdia se estende de geração em geração sobre os que o temem.",
                ],
                [
                    "title" => "Oração pelos que Sofrem",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Deus de toda consolação, olha com compaixão para todos os que estão sofrendo. Enxuga as lágrimas, cura as feridas e renova a esperança. Usa-nos como canais do teu amor e da tua misericórdia. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de entrega à vontade de Deus",
                    "category" => "fe",
                    "subcategory" => ["entrega", "confianca"],
                    "body" =>
                        "Senhor, entrego a minha vida nas tuas mãos. Confio que os teus planos para mim são de bem e não de mal, para me dar um futuro e uma esperança. Ajuda-me a confiar em ti mesmo quando não entendo. Que a tua vontade seja feita, não a minha. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Cordeiro de Deus",
                    "category" => "fe",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Cordeiro de Deus, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, dá-nos a paz.",
                ],
                [
                    "title" => "Oração de Confissão",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Senhor Deus, confesso os meus pecados diante de ti. Perdoa as minhas transgressões e purifica o meu coração. Cria em mim um coração puro e renova dentro de mim um espírito reto. Restaura a alegria da tua salvação. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração ao Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "santificacao"],
                    "body" =>
                        "Espírito Santo, enche-me da tua presença. Ensina-me todas as coisas e guia-me em toda a verdade. Produze em mim o teu fruto: amor, alegria, paz, paciência, bondade, fidelidade, mansidão e domínio próprio. Capacita-me para servir. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Filhos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, abençoa e protege os nossos filhos. Guia-os pelo caminho da verdade e dá-lhes sabedoria. Que eles cresçam no conhecimento e no amor de Deus. Guarda-os de todo mal e faze deles instrumentos de bênção. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelo Trabalho",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "trabalho"],
                    "body" =>
                        "Senhor Deus, abençoa o trabalho das nossas mãos. Dá-nos sabedoria e diligência em tudo o que fazemos. Que o nosso trabalho seja feito com excelência, integridade e para a tua glória. Abre portas de oportunidade segundo a tua vontade. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Davi",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Bendito és tu, Senhor Deus de Israel, por todos os séculos. Teu é o reino, o poder e a glória. Tudo o que temos vem de ti, e do que é teu te damos. Tu és exaltado acima de tudo. Que o teu nome seja louvado para sempre. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Elias",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Senhor Deus de Abraão, Isaque e Jacó, faze conhecido que tu és Deus. Responde-nos quando clamamos e mostra o teu poder. Não há outro Deus além de ti. Renova a nossa fé e confiança no teu cuidado. Em nome de Jesus, amém.",
                ],
            ],
            "other" => [
                [
                    "title" => "Pai Nosso",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Pai nosso que estás nos céus, santificado seja o teu nome. Venha o teu reino, seja feita a tua vontade, assim na terra como no céu. O pão nosso de cada dia nos dá hoje. Perdoa as nossas dívidas, assim como nós perdoamos aos nossos devedores. E não nos deixes cair em tentação, mas livra-nos do mal. Teu é o reino, o poder e a glória para sempre. Amém.",
                ],
                [
                    "title" => "Oração da Manhã",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Bom dia, Senhor! Entrego a ti esta manhã e todo este dia. Guia os meus passos, guarda os meus pensamentos e dirige as minhas palavras. Que eu seja luz onde houver trevas e sal onde houver sabor. Usa-me para a tua glória neste dia. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração da Noite",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "Senhor, ao encerrar este dia, eu te agradeço por cada momento vivido. Perdoa-me onde pequei e onde deixei de amar. Cura as feridas e renova as minhas forças. Em paz me deito e logo adormeço, porque só tu, Senhor, me fazes habitar em segurança. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Agradecimento",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, com todo o meu ser eu te agradeço. Pelas manhãs que se renovam, pelo alimento que me sustenta, pelas pessoas que amo e que me amam. Em tudo dá graças, pois esta é a tua vontade para mim. Obrigado por Tua fidelidade que se renova a cada manhã. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Louvor",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Grande és tu, Senhor, e digno de todo louvor! A minha alma te engrandece e o meu espírito se alegra em ti. Cantarei o teu amor para sempre e proclamarei a tua fidelidade a todas as gerações. Não há Deus como tu, ó Senhor. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Paz",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor Jesus, Príncipe da Paz, derrama a tua paz sobre o mundo. Acalma os corações aflitos, reconcilia os que estão em conflito e ensina-nos a viver em unidade. Que a tua paz, que excede todo o entendimento, guarde os nossos corações. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Enfermos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "cura"],
                    "body" =>
                        "Senhor Jesus, médico dos médicos, estende a tua mão curadora sobre todos os enfermos. Restaura a saúde dos corpos e a paz das almas. Fortalece os que cuidam e dá esperança aos que sofrem. Creio no teu poder de curar e renovar. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pela Família",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, abençoa e protege a minha família. Que o teu amor seja o fundamento do nosso lar. Concede-nos paciência, compreensão e perdão. Une-nos em amor e fé. Que cada membro da minha família conheça o teu amor e viva segundo a tua vontade. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos que Sofrem",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Deus de toda consolação, olha com compaixão para todos os que estão sofrendo. Enxuga as lágrimas, cura as feridas e renova a esperança. Usa-nos como canais do teu amor e da tua misericórdia. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelo Trabalho",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "trabalho"],
                    "body" =>
                        "Senhor Deus, abençoa o trabalho das minhas mãos. Dá-me sabedoria para realizar minhas tarefas com excelência e integridade. Abre portas de oportunidade e concede-me favor diante das pessoas. Que o meu trabalho seja uma bênção para outros e uma oferta de adoração a ti. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Confissão",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Senhor Deus, reconheço diante de ti que pequei. Perdoa as minhas transgressões e purifica o meu coração. Cria em mim um coração puro e renova dentro de mim um espírito estável. Não me lances fora da tua presença nem retires de mim o teu Santo Espírito. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração ao Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "santificacao"],
                    "body" =>
                        "Vem, Espírito Santo, enche-me da tua presença. Ensina-me todas as coisas e lembra-me das palavras de Jesus. Dá-me poder para testemunhar e dons para servir. Produze em mim o teu fruto: amor, alegria, paz, paciência, bondade, fidelidade, mansidão e domínio próprio. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Consagração",
                    "category" => "fe",
                    "subcategory" => ["fe", "santificacao"],
                    "body" =>
                        "Senhor, apresento o meu corpo como sacrifício vivo, santo e agradável a ti, que é o meu culto racional. Não me conforme com este mundo, mas transforma-me pela renovação da minha mente. Tudo o que sou e tudo o que tenho pertence a ti. Usa-me para a tua glória. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de entrega à vontade de Deus",
                    "category" => "fe",
                    "subcategory" => ["entrega", "confianca"],
                    "body" =>
                        "Senhor, entrego a minha vida nas tuas mãos. Confio que os teus planos para mim são de bem e não de mal, para me dar um futuro e uma esperança. Ajuda-me a confiar em ti mesmo quando não entendo. Que a tua vontade seja feita, não a minha. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração de Intercessão",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, coloco diante de ti as necessidades daqueles que amo. Intercedo por aqueles que estão sofrendo, pelos que estão perdidos, pelos que estão doentes e pelos que estão desanimados. Usa-me como canal da tua bênção. Que a tua vontade seja feita na vida de cada um. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Oração pelos Filhos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, entrego meus filhos em tuas mãos. Protege-os de todo o mal, guia-os pelo caminho da verdade e enche-os do teu Espírito. Dá-lhes sabedoria, saúde e um coração que te ame. Que eles cresçam em graça e conhecimento, e sejam instrumentos teus onde quer que forem. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Glória ao Pai",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Glória ao Pai, e ao Filho, e ao Espírito Santo, como era no princípio, agora e sempre, por todos os séculos. Amém.",
                ],
                [
                    "title" => "Oração antes das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Deus, abençoa este alimento que vamos receber. Assim como sustentas o nosso corpo, alimenta também a nossa alma com a tua palavra. Lembra-nos dos que têm fome e ajuda-nos a compartilhar com generosidade. Em nome de Jesus, amém.",
                ],
                [
                    "title" => "Cordeiro de Deus",
                    "category" => "fe",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Cordeiro de Deus, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, dá-nos a paz.",
                ],
                [
                    "title" => "Oração de São Francisco",
                    "category" => "fe",
                    "subcategory" => ["fe", "paz"],
                    "body" =>
                        "Senhor, fazei-me instrumento da vossa paz. Onde houver ódio, que eu leve o amor; onde houver ofensa, que eu leve o perdão; onde houver discórdia, que eu leve a união; onde houver dúvida, que eu leve a fé; onde houver desespero, que eu leve a esperança; onde houver trevas, que eu leve a luz. Porque é dando que se recebe, é perdoando que se é perdoado. Amém.",
                ],
            ],
            "orthodox" => [
                [
                    "title" => "Oração de Jesus",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Senhor Jesus Cristo, Filho de Deus, tem misericórdia de mim, pecador. Senhor Jesus Cristo, Filho de Deus, tem misericórdia de nós. Pela intercessão de nossa Santíssima Senhora, a Theotokos e sempre Virgem Maria, e de todos os santos, tem misericórdia de nós. Amém.",
                ],
                [
                    "title" => "Ó Rei Celestial",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "fe"],
                    "body" =>
                        "Ó Rei Celestial, Consolador, Espírito da Verdade, que estás em toda a parte e tudo preenches, Tesouro de bênçãos e Doador da vida: vem e habita em nós, purifica-nos de toda a mancha, e salva as nossas almas, ó Bondoso. Amém.",
                ],
                [
                    "title" => "Pai Nosso",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Pai nosso que estás nos céus, santificado seja o teu nome; venha a nós o teu reino; seja feita a tua vontade, assim na terra como no céu. O pão nosso de cada dia nos dá hoje; e perdoa-nos as nossas ofensas, assim como nós perdoamos a quem nos tem ofendido; e não nos deixes cair em tentação, mas livra-nos do mal. Pois teu é o reino, o poder e a glória, do Pai e do Filho e do Espírito Santo, agora e sempre e pelos séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Oração da Manhã",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Ao levantar-me do sono, prostro-me diante de ti, ó Mestre que amas a humanidade. Agradeço-te por não me destruíres com minhas iniquidades, mas por teu amor poupaste a minha vida. Ilumina os meus olhos e concede-me aprender a tua vontade e cumprir os teus mandamentos. Que a minha oração da manhã suba até ti como incenso. Amém.",
                ],
                [
                    "title" => "Oração da Noite",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "Senhor nosso Deus, perdoa-me tudo o que pequei neste dia em pensamentos, palavras e obras. Concede-me um sono tranquilo e sem perturbações. Envia o teu anjo para me proteger e guardar de toda cilada do inimigo. Pois tu és o guarda das nossas almas e dos nossos corpos, e a ti damos glória. Amém.",
                ],
                [
                    "title" => "Triságio",
                    "category" => "santificacao",
                    "subcategory" => ["santificacao", "fe"],
                    "body" =>
                        "Santo Deus, Santo Forte, Santo Imortal, tem piedade de nós. Santo Deus, Santo Forte, Santo Imortal, tem piedade de nós. Santo Deus, Santo Forte, Santo Imortal, tem piedade de nós. Glória ao Pai e ao Filho e ao Espírito Santo, agora e sempre e pelos séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Oração à Theotokos",
                    "category" => "intercessao",
                    "subcategory" => ["virgem_maria", "intercessao"],
                    "body" =>
                        "Santíssima Theotokos, salva-nos. Virgem soberana, Mãe de Deus, que deste à luz o Salvador de nossas almas, intercede por nós diante do teu Filho e nosso Deus. Abriga-nos sob o teu manto de proteção. Não nos desprezes em nossas aflições, mas livra-nos de todo perigo, ó única pura e bendita. Amém.",
                ],
                [
                    "title" => "Oração ao Anjo da Guarda",
                    "category" => "protecao",
                    "subcategory" => ["anjo_da_guarda", "protecao"],
                    "body" =>
                        "Anjo de Deus, meu santo guardião, que me foi dado do céu para minha proteção, eu te suplico com fervor: ilumina-me, guarda-me e mantém-me longe de toda cilada do inimigo. Guia-me para o caminho da salvação e intercede por mim diante de Deus. Amém.",
                ],
                [
                    "title" => "Tropário à Trindade",
                    "category" => "santificacao",
                    "subcategory" => ["santificacao", "fe"],
                    "body" =>
                        "Tendo nos levantado do sono, prostramo-nos diante de ti, ó Trindade Santa e Una. Louvamos a tua bondade e te glorificamos, ó Deus: Santíssima Trindade, tende piedade de nós. Senhor, purifica os nossos pecados. Mestre, perdoa as nossas iniquidades. Santo, visita e cura as nossas fraquezas por amor do teu nome.",
                ],
                [
                    "title" => "Credo Niceno-Constantinopolitano",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Creio em um só Deus, Pai Todo-poderoso, Criador do céu e da terra, de todas as coisas visíveis e invisíveis. Creio em um só Senhor, Jesus Cristo, Filho Unigênito de Deus, gerado do Pai antes de todos os séculos. Luz da Luz, Deus verdadeiro de Deus verdadeiro, gerado, não criado, consubstancial ao Pai, por quem tudo foi feito. Por nós homens e pela nossa salvação desceu dos céus e se encarnou pelo Espírito Santo e da Virgem Maria, e se fez homem. Foi crucificado por nós sob Pôncio Pilatos, padeceu e foi sepultado. Ressuscitou ao terceiro dia, segundo as Escrituras, subiu aos céus e está sentado à direita do Pai. E novamente há de vir com glória para julgar os vivos e os mortos, e o seu reino não terá fim. Creio no Espírito Santo, Senhor que dá a vida, e procede do Pai, e com o Pai e o Filho é adorado e glorificado, e falou pelos profetas. Creio na Igreja, Una, Santa, Católica e Apostólica. Confesso um só batismo para a remissão dos pecados. Espero a ressurreição dos mortos e a vida do século vindouro. Amém.",
                ],
                [
                    "title" => "Oração de São Basílio Magno",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, que nos concedeste chegar a esta hora, perdoa as nossas transgressões voluntárias e involuntárias, cometidas por palavra, ação ou pensamento. Vela por nós, guia-nos e fortalece-nos. Concede-nos passar o dia em paz e alegria espiritual. Pois tu és o nosso Deus e a ti damos glória. Amém.",
                ],
                [
                    "title" => "Oração de São João Crisóstomo",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor, concede-me a graça de te amar acima de todas as coisas e a meu próximo como a mim mesmo. Concede-me paciência nas tribulações, humildade nas alegrias e sabedoria em todas as circunstâncias. Ensina-me a fazer a tua vontade e a glorificar o teu santo nome. Amém.",
                ],
                [
                    "title" => "Oração de Santo Efrém da Síria",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "santificacao"],
                    "body" =>
                        "Senhor e Mestre da minha vida, afasta de mim o espírito de desânimo, de negligência, de amor ao poder e de conversa fiada. Concede-me, teu servo, o espírito de castidade, de humildade, de paciência e de amor. Sim, Senhor e Rei, concede-me ver as minhas próprias faltas e não julgar o meu irmão, pois tu és bendito pelos séculos dos séculos. Amém.",
                ],
                [
                    "title" => "Oração pelos Vivos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Jesus Cristo, Filho de Deus, tem piedade de todos os que vivem na fé e na esperança em ti. Abençoa e protege os nossos pais, irmãos, amigos e todos os que nos pediram orações. Concede-lhes saúde, paz e prosperidade espiritual. E a todos os que estão em aflição, estende a tua mão consoladora. Amém.",
                ],
                [
                    "title" => "Oração pelos Falecidos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Senhor, dá o repouso eterno a todos os teus servos que partiram desta vida na fé e na esperança da ressurreição. Perdoa-lhes toda falta cometida por palavra, ação ou pensamento. Concede-lhes habitar na luz da tua face, onde não há dor, nem sofrimento, mas a vida eterna. Amém.",
                ],
                [
                    "title" => "Oração pelos Inimigos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "perdao"],
                    "body" =>
                        "Senhor, abençoa os que me perseguem e têm ódio de mim. Perdoa-lhes, pois não sabem o que fazem. Converte os seus corações e concede-lhes a salvação. Livra-me de todo ressentimento e ensina-me a amar como tu amas. Pois tu és o Deus do amor e da misericórdia. Amém.",
                ],
                [
                    "title" => "Oração antes das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Pai nosso, que estás nos céus, abençoa estes alimentos que vamos receber da tua bondade. Santifica-os e santifica-nos, para que sejam para o fortalecimento do corpo e da alma, e não para a gula. Glória a ti, Senhor, por todos os teus dons. Amém.",
                ],
                [
                    "title" => "Oração depois das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Graças te damos, Cristo nosso Deus, porque nos saciaste com teus dons terrenos. Não nos prives do teu reino celestial, mas assim como vieste ao encontro dos teus discípulos, vem ao nosso encontro e concede-nos a paz. Glória a ti, Senhor, em todos os séculos. Amém.",
                ],
                [
                    "title" => "Salmo 50 — Misericórdia",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Tem misericórdia de mim, ó Deus, segundo a tua bondade; segundo a tua imensa compaixão, apaga as minhas transgressões. Lava-me completamente da minha iniquidade e purifica-me do meu pecado. Cria em mim um coração puro, ó Deus, e renova dentro de mim um espírito inabalável. Não me lances fora da tua presença nem retires de mim o teu Santo Espírito.",
                ],
                [
                    "title" => "Oração de Arrependimento",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Deus misericordioso, pequei contra ti em pensamentos, palavras e obras. Como o filho pródigo, volto para ti com o coração contrito. Recebe-me como a um dos teus servos e purifica-me com a tua graça. Pois tu não desprezas um coração contrito e humilhado. Amém.",
                ],
                [
                    "title" => "Oração de São Simeão",
                    "category" => "fe",
                    "subcategory" => ["fe", "esperanca"],
                    "body" =>
                        "Agora, Senhor, despedes em paz o teu servo, segundo a tua palavra. Pois os meus olhos viram a tua salvação, que preparaste diante de todos os povos: luz para revelação aos gentios e glória do teu povo Israel. Glória ao Pai e ao Filho e ao Espírito Santo. Amém.",
                ],
                [
                    "title" => "Oração pela Unidade",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor Jesus Cristo, que oraste para que todos sejam um, concede à tua Igreja a unidade do Espírito no vínculo da paz. Cura as divisões entre os cristãos e guia-nos todos à plenitude da verdade no amor. Que o mundo creia porque nos amamos uns aos outros. Amém.",
                ],
                [
                    "title" => "Oração de Louvor",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Bendito sejas, Senhor Deus de nossos pais, louvado e exaltado acima de tudo para sempre. Bendito seja o teu santo e glorioso nome, louvado e exaltado acima de tudo para sempre. Bendito sejas no teu santo templo de glória. Louvemos e exaltemos a Deus acima de tudo para sempre. Amém.",
                ],
                [
                    "title" => "Oração pelos que Sofrem",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Senhor, olha com amor para todos os que sofrem. Conforta os tristes, cura os doentes, liberta os cativos, alimenta os famintos e acolhe os desamparados. Que cada lágrima seja enxugada e cada coração encontre paz em ti. Pois tu és o Deus de toda consolação. Amém.",
                ],
                [
                    "title" => "Oração pela Viagem",
                    "category" => "protecao",
                    "subcategory" => ["protecao", "fe"],
                    "body" =>
                        "Senhor Jesus Cristo, que viajaste com os discípulos a Emaús, acompanha-nos em nossa viagem. Protege-nos de todo perigo e guia-nos com segurança ao nosso destino. Abençoa os que ficam e os que partem, e que em tudo seja feita a tua santa vontade. Amém.",
                ],
                [
                    "title" => "Oração de São Macário",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Desperta-me, Senhor, para te louvar e glorificar o teu santo nome. Concede-me passar este dia em paz e santidade. Guarda-me de todo pecado e livra-me de toda tentação. Pois tu és o meu Deus e a ti ofereço a minha vida. Amém.",
                ],
                [
                    "title" => "Oração de São Silouan",
                    "category" => "santificacao",
                    "subcategory" => ["santificacao", "humildade"],
                    "body" =>
                        "Senhor, concede-me a graça da humildade e do amor. Ensina-me a não julgar o meu próximo, mas a ver as minhas próprias faltas. Que o teu amor me envolva e me transforme, para que eu possa amar a todos como tu nos amaste. Mantém a minha mente no coração e livra-me dos pensamentos dispersos. Amém.",
                ],
                [
                    "title" => "Oração de São Serafim de Sarov",
                    "category" => "fe",
                    "subcategory" => ["fe", "alegria"],
                    "body" =>
                        "Senhor, concede-me a verdadeira alegria do Espírito Santo. Que eu irradie a tua paz e o teu amor por onde quer que vá. Ajuda-me a receber a todos com mansidão e bondade, vendo em cada pessoa a imagem de Deus. Salva-nos, Senhor, e dá-nos a tua paz. Amém.",
                ],
                [
                    "title" => "Oração de Agradecimento",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Graças te damos, Senhor Deus de todos, por todos os teus benefícios. Pela vida que nos deste, pela criação que nos rodeia e pela tua infinita misericórdia. Bendito sejas pelos séculos. Glória a ti, Senhor, por tudo. Amém.",
                ],
                [
                    "title" => "Oração de Louvor",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Bendito sejas, Senhor Deus de nossos pais, louvado e exaltado acima de tudo para sempre. Bendito seja o teu santo nome, louvado e exaltado acima de tudo para sempre. Bendito sejas no firmamento do céu. Louvemos e exaltemos a Deus acima de tudo para sempre. Amém.",
                ],
                [
                    "title" => "Glória ao Pai",
                    "category" => "geral",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Glória ao Pai, e ao Filho, e ao Espírito Santo, agora e sempre e pelos séculos dos séculos. Amém. Glória a ti, nosso Deus, glória a ti.",
                ],
                [
                    "title" => "Oração antes das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Cristo Deus, abençoa estes alimentos que vamos receber da tua bondade. Assim como alimentas o nosso corpo, alimenta a nossa alma com a tua graça. Pois tu és o pão da vida e a fonte de toda bênção. Glória a ti, Senhor. Amém.",
                ],
                [
                    "title" => "Oração depois das Refeições",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "Graças te damos, Cristo nosso Deus, porque nos saciaste com teus dons terrenos. Não nos prives do teu reino celestial. Glória a ti, Senhor, que enches de bondade a nossa vida. Amém.",
                ],
                [
                    "title" => "Oração pela Paz",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "paz"],
                    "body" =>
                        "Senhor Jesus Cristo, príncipe da paz, concede a paz ao mundo. Acalma as tempestades das nações e reconcilia os corações divididos. Derrama o teu Espírito de amor e unidade sobre todos os povos. Pela intercessão da Theotokos e de todos os santos, tem piedade de nós. Amém.",
                ],
                [
                    "title" => "Oração pelos Enfermos",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "cura"],
                    "body" =>
                        "Senhor Jesus Cristo, médico das almas e dos corpos, visita com a tua misericórdia todos os enfermos. Estende a tua mão curadora e concede-lhes saúde e paciência. Fortalece os que cuidam e dá esperança aos que sofrem. Glória a ti, Senhor. Amém.",
                ],
                [
                    "title" => "Oração pela Família",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "fe"],
                    "body" =>
                        "Senhor Deus, abençoa e protege as nossas famílias. Que o teu amor seja o fundamento dos nossos lares. Concede-nos paciência, perdão e compreensão. Santifica a nossa convivência e guia-nos pelo caminho da salvação. Pela intercessão da Theotokos, tem piedade de nós. Amém.",
                ],
                [
                    "title" => "Oração pelos que Sofrem",
                    "category" => "intercessao",
                    "subcategory" => ["intercessao", "esperanca"],
                    "body" =>
                        "Senhor, olha com amor para todos os que sofrem e estão aflitos. Conforta os tristes, cura os doentes, acolhe os desamparados. Enxuga toda lágrima e dá repouso às almas cansadas. Pois tu és o Deus de toda consolação. Amém.",
                ],
                [
                    "title" => "Oração pelo Trabalho",
                    "category" => "fe",
                    "subcategory" => ["fe", "trabalho"],
                    "body" =>
                        "Senhor Jesus Cristo, abençoa o trabalho das nossas mãos. Concede-nos sabedoria e diligência em nossas tarefas. Que o nosso trabalho seja uma oferta a ti e uma bênção para o próximo. Glória a ti, que nos sustentas com a tua mão generosa. Amém.",
                ],
                [
                    "title" => "Oração de Consagração",
                    "category" => "fe",
                    "subcategory" => ["fe", "santificacao"],
                    "body" =>
                        "Senhor e Mestre da minha vida, a ti ofereço todo o meu ser. Que os meus pensamentos, palavras e ações sejam para a tua glória. Purifica-me, santifica-me e guarda-me no teu amor. Pois tu és o meu Deus e a ti entrego a minha vida. Amém.",
                ],
                [
                    "title" => "Oração de Davi",
                    "category" => "amor",
                    "subcategory" => ["adoracao", "fe"],
                    "body" =>
                        "Bendito és tu, Senhor Deus de Israel, por todos os séculos. Teu é o reino, o poder e a glória. Que o teu nome seja exaltado acima de todo nome. Louvemos e exaltemos a Deus acima de tudo para sempre. Amém.",
                ],
                [
                    "title" => "Oração de Ana",
                    "category" => "fe",
                    "subcategory" => ["fe", "adoracao"],
                    "body" =>
                        "O meu coração se alegra no Senhor, a minha força é exaltada no meu Deus. Não há santo como o Senhor, não há rocha como o nosso Deus. Ele guarda os pés dos seus santos e exalta os humildes. Glória a ti, Senhor, por todos os séculos. Amém.",
                ],
                [
                    "title" => "Oração de Elias",
                    "category" => "fe",
                    "subcategory" => ["fe", "intercessao"],
                    "body" =>
                        "Senhor Deus de Abraão, Isaque e Israel, faze conhecido que tu és Deus. Responde ao clamor do teu povo e mostra a tua glória. Converte os corações e renova a nossa fé. Pois tu és o único Deus verdadeiro. Glória a ti, Senhor. Amém.",
                ],
                [
                    "title" => "Oração de entrega à vontade de Deus",
                    "category" => "fe",
                    "subcategory" => ["fe", "confianca"],
                    "body" =>
                        "Senhor Jesus Cristo, nas tuas mãos entrego o meu espírito. Confio na tua santa vontade e aceito tudo o que vier de ti. Concede-me paciência nas tribulações e gratidão nas alegrias. Glória a ti, que tudo dispões com sabedoria e amor. Amém.",
                ],
                [
                    "title" => "Cordeiro de Deus",
                    "category" => "arrependimento",
                    "subcategory" => ["perdao", "fe"],
                    "body" =>
                        "Cordeiro de Deus, Filho do Pai, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, tem piedade de nós. Cordeiro de Deus, que tiras o pecado do mundo, concede-nos a paz. Santo Deus, Santo Forte, Santo Imortal, tem piedade de nós.",
                ],
                [
                    "title" => "Oração a São Miguel Arcanjo",
                    "category" => "protecao",
                    "subcategory" => ["protecao", "batalha_espiritual"],
                    "body" =>
                        "São Miguel Arcanjo, comandante das hostes celestes, defendei-nos no combate espiritual. Protegei-nos de toda cilada do inimigo e guiai-nos para a salvação. Pela vossa intercessão, que o Senhor nos conceda a vitória sobre as forças do mal. Amém.",
                ],
                [
                    "title" => "Oração a São Jorge",
                    "category" => "protecao",
                    "subcategory" => ["protecao", "fe"],
                    "body" =>
                        "São Jorge, grande mártir e vencedor, que testemunhaste a fé em Cristo até o fim, intercede por nós diante do trono de Deus. Ajuda-nos a vencer as batalhas espirituais e a permanecer firmes na fé. Glorioso São Jorge, rogai por nós. Amém.",
                ],
                [
                    "title" => "Oração de Confissão",
                    "category" => "arrependimento",
                    "subcategory" => ["arrependimento", "perdao"],
                    "body" =>
                        "Deus misericordioso, pequei contra ti em pensamentos, palavras e obras. Como o filho pródigo, volto para ti com o coração contrito. Recebe-me e purifica-me com a tua graça. Pois tu não desprezas um coração contrito e humilhado. Concede-me o teu perdão. Amém.",
                ],
                [
                    "title" => "Oração ao Espírito Santo",
                    "category" => "santificacao",
                    "subcategory" => ["espirito_santo", "santificacao"],
                    "body" =>
                        "Ó Rei Celestial, Espírito da Verdade, que procedes do Pai e repousas sobre o Filho, vem e habita em nós. Purifica-nos de toda mancha e santifica as nossas almas. Concede-nos os teus dons e guia-nos para a vida eterna. Amém.",
                ],
            ],
        ];
    }
}
