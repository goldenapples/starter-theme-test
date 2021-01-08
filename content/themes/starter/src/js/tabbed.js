/**
 * Tabbed navigation for switching between content tabs.
 */

/**
 * Show the tabbed navigation.
 */
const showTabbedNav = () => {
	const tabbedNavElements = document.querySelectorAll( '.tabbed-nav-list' );
	const tabbedNavLinks = document.querySelectorAll( '.tabbed-nav-list a' );
	const tabbedContentHeadings = document.querySelectorAll(
		'.tabbed-content .section-heading'
	);

	tabbedContentHeadings.forEach( ( heading ) => {
		heading.classList.add( 'screen-reader-text' );
	} );

	tabbedNavLinks.forEach( ( tabbedNavLink ) => {
		tabbedNavLink.addEventListener( 'click', tabbedNavClick );
	} );

	tabbedNavElements.forEach( ( tabbedNavElement ) => {
		tabbedNavElement.style.display = 'flex';
		tabbedNavElement.querySelector( 'li:first-of-type a' ).click();
	} );
};

/**
 * Manage active classes, active content.
 *
 * @param {Event} event click event on a tabbed nav element.
 */
const tabbedNavClick = ( event ) => {
	event.preventDefault();

	const currentElement = event.target;
	const currentElementParent = currentElement.closest( '.tabbed-nav-list' );
	const siblings = currentElementParent.querySelectorAll( 'a' );
	const tabbedContent = currentElementParent.parentNode.querySelectorAll(
		'.tabbed-content'
	);
	let currentElementHref = currentElement.getAttribute( 'href' );
	currentElementHref = currentElementHref.replace( '#', '' );

	currentElement.classList.add( 'active' );

	// Remove active class for other children of this item's parent.
	siblings.forEach( ( link ) => {
		if ( currentElement !== link ) {
			link.classList.remove( 'active' );
		}
	} );

	tabbedContent.forEach( ( content ) => {
		if ( content.classList.contains( currentElementHref ) ) {
			content.classList.remove( 'hidden' );
		} else {
			content.classList.add( 'hidden' );
		}
	} );
};

/**
 * Removes event listeners.
 */
const removeEventListeners = () => {
	const tabbedNavLinks = document.querySelectorAll( '.tabbed-nav-list a' );
	tabbedNavLinks.forEach( ( link ) => {
		link.removeEventListener( 'click', tabbedNavClick );
	} );
};

/**
 * Kick it all off.
 */
const bootstrap = () => {
	showTabbedNav();
};

/**
 * Re-initialize listeners on updates to this module.
 */
if ( module.hot ) {
	module.hot.accept();
	module.hot.dispose( removeEventListeners );
	bootstrap();
} else {
	document.addEventListener( 'DOMContentLoaded', bootstrap );
}
