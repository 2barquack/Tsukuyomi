<?php
/**
 * Plugin Name: PCI Form Submits CLI
 * Description: WP-CLI command to manage form submissions in a custom database table.
 * Author: 2-Bar Quack
 * Version: 1.0.0
 */

if ( defined( 'WP_CLI' ) && WP_CLI ) {

    class PCI_Form_Submits_CLI {

        private $table;

        public function __construct() {
            global $wpdb;
            $this->table = $wpdb->prefix . 'form_submits';
        }

        /**
         * Create the form_submits table if it doesn’t exist.
         *
         * ## EXAMPLES
         *
         *     wp pci_form_submits create_table
         */
        public function create_table() {
            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
                id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                email varchar(255) NOT NULL,
                first_name varchar(100) NOT NULL,
                last_name varchar(100) NOT NULL,
                lead_source varchar(255) NOT NULL,
                form_json longtext NULL,
                api_return_id varchar(255) NULL,
                ip_address varchar(45) NULL,
                created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                type varchar(100) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta( $sql );

            WP_CLI::success( "Table {$this->table} has been created or already exists." );
        }

        /**
         * Insert a new form submission.
         *
         * ## OPTIONS
         *
         * [--email=<email>]
         * : Email address (required)
         *
         * [--first_name=<first_name>]
         * : First name (required)
         *
         * [--last_name=<last_name>]
         * : Last name (required)
         *
         * [--lead_source=<lead_source>]
         * : Lead source (required)
         *
         * [--type=<type>]
         * : Submission type (required, e.g., business_funding or standard)
         *
         * [--form_json=<form_json>]
         * : Optional JSON string of form fields
         *
         * [--api_return_id=<api_return_id>]
         * : Optional API return ID
         *
         * [--ip_address=<ip_address>]
         * : Optional IP address
         *
         * ## EXAMPLES
         *
         *     wp pci_form_submits insert --email=test@example.com --first_name=John --last_name=Doe --lead_source=Website --type=standard
         */
        public function insert( $args, $assoc_args ) {
            global $wpdb;

            // Validate required fields
            $required = ['email', 'first_name', 'last_name', 'lead_source', 'type'];
            foreach ( $required as $field ) {
                if ( empty( $assoc_args[$field] ) ) {
                    WP_CLI::error( "Missing required field: $field" );
                    return;
                }
            }

            // Email validation
            if ( ! filter_var( $assoc_args['email'], FILTER_VALIDATE_EMAIL ) ) {
                WP_CLI::error( "Invalid email format: " . $assoc_args['email'] );
                return;
            }

            $data = [
                'email'        => sanitize_email( $assoc_args['email'] ),
                'first_name'   => sanitize_text_field( $assoc_args['first_name'] ),
                'last_name'    => sanitize_text_field( $assoc_args['last_name'] ),
                'lead_source'  => sanitize_text_field( $assoc_args['lead_source'] ),
                'type'         => sanitize_text_field( $assoc_args['type'] ),
                'form_json'    => isset( $assoc_args['form_json'] ) ? wp_kses_post( $assoc_args['form_json'] ) : null,
                'api_return_id'=> isset( $assoc_args['api_return_id'] ) ? sanitize_text_field( $assoc_args['api_return_id'] ) : null,
                'ip_address'   => isset( $assoc_args['ip_address'] ) ? sanitize_text_field( $assoc_args['ip_address'] ) : null,
                'created_at'   => current_time( 'mysql' ),
            ];

            $inserted = $wpdb->insert( $this->table, $data );

            if ( $inserted ) {
                WP_CLI::success( "Form submission inserted successfully." );
            } else {
                WP_CLI::error( "Failed to insert submission." );
            }
        }

        /**
         * List form submissions.
         *
         * ## EXAMPLES
         *
         *     wp pci_form_submits list
         */
        public function list( $args, $assoc_args ) {
            global $wpdb;

            $results = $wpdb->get_results( "SELECT * FROM {$this->table} ORDER BY created_at DESC", ARRAY_A );

            if ( empty( $results ) ) {
                WP_CLI::log( "No submissions found." );
                return;
            }

            WP_CLI\Utils\format_items( 'table', $results, array_keys( $results[0] ) );
        }
    }

    WP_CLI::add_command( 'pci_form_submits', 'PCI_Form_Submits_CLI' );
}
