<?php
/**
 * Support class.
 *
 * @link  https://www.boldgrid.com
 * @since 1.1.0
 *
 * @package    Boldgrid_Backup
 * @subpackage Boldgrid_Backup/admin
 * @copyright  BoldGrid
 * @version    $Id$
 * @author     BoldGrid <support@boldgrid.com>
 */

/**
 * Support class.
 *
 * @since 1.1.0
 */
class Boldgrid_Backup_Premium_Admin_Support {
	/**
	 * The core class object.
	 *
	 * @since 1.1.0
	 * @var Boldgrid_Backup_Admin_Core
	 */
	private $core;

	/**
	 * An instance of Boldgrid_Backup_Premium_Admin_Core.
	 *
	 * @since 1.1.0
	 * @var   Boldgrid_Backup_Premium_Admin_Core
	 */
	private $premium_core;

	/**
	 * Constructor.
	 *
	 * @since 1.1.0
	 *
	 * @param Boldgrid_Backup_Admin_Core         $core         Boldgrid_Backup_Admin_Core object.
	 * @param Boldgrid_Backup_Premium_Admin_Core $premium_core Boldgrid_Backup_Premium_Admin_Core object.
	 */
	public function __construct( Boldgrid_Backup_Admin_Core $core, Boldgrid_Backup_Premium_Admin_Core $premium_core ) {
		$this->core         = $core;
		$this->premium_core = $premium_core;
	}

	/**
	 * Whether or not the BoldGrid Backup Premium plugin should register its hooks.
	 *
	 * @since 1.1.0
	 *
	 * @return bool
	 */
	public function has_hook_support() {
		return $this->has_parent_version( true );
	}

	/**
	 * Whether or not we have the minimum version of the BoldGrid Backup plugin.
	 *
	 * @since 1.1.0
	 *
	 * @param  bool $admin_notice Whether or not to show an admin notice if the we don't have the
	 *                            minimum version.
	 * @return bool
	 */
	public function has_parent_version( $admin_notice = false ) {
		$configs = $this->premium_core->get_configs();

		$support = version_compare( BOLDGRID_BACKUP_VERSION, $configs['required_parent_version'], '>=' );

		if ( ! $support && $admin_notice ) {
			$message = sprintf(
				/* translators: 1 the required BoldGrid Backup plugin version, 2 the actual version, 3 opening <strong> tag, 4 closing </strong> tag, 5 opening <a> tag to updates page, 6 closing </a> tag. */
				__( 'The %3$sBoldGrid Backup Premium%4$s plugin requires version %1$s of the %3$sBoldGrid Backup%4$s plugin to run, but you are running version %2$s. Please %5$supdate your %3$sBoldGrid Backup%4$s plugin%6$s to continue.', 'boldgrid-bacukp' ),
				$configs['required_parent_version'],
				BOLDGRID_BACKUP_VERSION,
				'<strong>',
				'</strong>',
				'<a href="' . admin_url( 'update-core.php' ) . '">',
				'</a>'
			);

			add_action( 'admin_notices', function() use ( $message ) {
				$this->core->notice->boldgrid_backup_notice( $message );
			} );
		}

		return $support;
	}
}
