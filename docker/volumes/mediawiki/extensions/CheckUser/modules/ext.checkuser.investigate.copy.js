/* eslint-disable no-jquery/no-global-selector */

/**
 * Feature for copying wikitext version of the Compare results table (T251361).
 * This feature is available for wikis that have Parsoid/RESTBase.
 */
module.exports = function addCopyFeature() {
	var copyTextLayout, messageWidget, wikitextButton;

	function onWikitextButtonClick() {
		var url, html;

		function getSanitizedHtml( $table ) {
			$table = $table.clone();

			$table.find( '.oo-ui-widget, .ext-checkuser-investigate-table-options-container' ).remove();
			$table.find( '.mw-userlink' )
				.attr( 'rel', 'mw:WikiLink' )
				.attr( 'href', function () {
					return new mw.Uri( $( this ).attr( 'href' ) ).toString();
				} );

			$table.find( '[class]' ).addBack( '[class]' ).removeAttr( 'class' );
			$table.addClass( 'mw-datatable' );

			$table.find( 'tr, td' ).each( function ( i, element ) {
				Object.keys( element.dataset ).forEach( function ( key ) {
					element.removeAttribute( 'data-' + key );
				} );
			} );

			return $table[ 0 ].outerHTML;
		}

		wikitextButton.setDisabled( true );
		copyTextLayout.textInput.pushPending();
		copyTextLayout.toggle( true );

		url = mw.config.get( 'wgVisualEditorConfig' ).fullRestbaseUrl + 'v1/transform/html/to/wikitext/';
		html = getSanitizedHtml( $( '.ext-checkuser-investigate-table-compare' ) );

		$.ajax( url, { data: { html: html }, type: 'POST' } ).then( function ( data ) {
			copyTextLayout.textInput.popPending();
			copyTextLayout.textInput.setValue( data );
		} );
	}

	messageWidget = new OO.ui.MessageWidget( {
		type: 'notice',
		label: mw.msg( 'checkuser-investigate-compare-copy-message-label' ),
		classes: [ 'ext-checkuser-investigate-copy-message' ]
	} );
	messageWidget.setIcon( 'articles' );

	wikitextButton = new OO.ui.ButtonWidget( {
		label: mw.msg( 'checkuser-investigate-compare-copy-button-label' ),
		flags: [ 'primary', 'progressive' ]
	} );
	wikitextButton.on( 'click', onWikitextButtonClick );

	copyTextLayout = new mw.widgets.CopyTextLayout( {
		multiline: true,
		align: 'top',
		textInput: {
			autosize: true,
			// The following classes are used here:
			// * mw-editfont-monospace
			// * mw-editfont-sans-serif
			// * mw-editfont-serif
			classes: [ 'mw-editfont-' + mw.user.options.get( 'editfont' ) ]
		}
	} );
	copyTextLayout.toggle( false );

	$( '.oo-ui-indexLayout-stackLayout' ).append(
		messageWidget.$element.append(
			wikitextButton.$element,
			copyTextLayout.$element
		)
	);
};
