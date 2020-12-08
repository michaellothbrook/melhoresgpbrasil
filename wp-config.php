<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'melhoresgpbrasil' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'haT9q~:o7.HI23K#@Mbozx)ION1AizF`*lGV13iC>o4=Ollp_1U0& :sj2^[&gVY' );
define( 'SECURE_AUTH_KEY',  '/y_enq<0GDBPNG6D7O83fC`h7*n2ZiIY4Hsv$9d7 #}rn#ei5ZV$?WZv%W7#3G$(' );
define( 'LOGGED_IN_KEY',    '0`ypm@B7bI(NgV>z8H1@G~-wc0/sU#)gyUmE,5h_?xg8E5FIqgOX3>wmqzlnxFC#' );
define( 'NONCE_KEY',        '!SrB4n!64j54XS-xy7ew d?/hv:Zcw&B:ZgL4yCrK^E^ATCSeW^m1g.Ee.K^r#jA' );
define( 'AUTH_SALT',        '[rfa~B6j&;--r>m_G:)Z/tn^bhwHD0~c8I8WcwW*h1Xvm<PyO7]%qjZ@Ed[>,2[o' );
define( 'SECURE_AUTH_SALT', '!%1+F7?7T0k.D>*ebgfUw@Z&|aUy(02kt }f]aK={p7~,gKY~::W%g/S0W??yZhZ' );
define( 'LOGGED_IN_SALT',   'F`G!q)6bg:(3pq*vm-H1 qtx9fINqY?mo}Z(4W::~zqi`/Lu;}f8`V}(~:Ci;6ZA' );
define( 'NONCE_SALT',       'B6x%FLw-qslHBE>z*?}!:ig+-Sfv.3jMPV&9K|Pkrazl}f@G}xt2RXPo;&M)j+LA' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'mgpb_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
