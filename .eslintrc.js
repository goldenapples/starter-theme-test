/* eslint quote-props: [ 'error', 'always' ] */
module.exports = {
	'env': {
		'es6': true,
	},
	'extends': '@humanmade/eslint-config',
	'rules': {
		'arrow-parens': [ 'error', 'always' ],
		'react/jsx-curly-newline': 'off',
		'react/react-in-jsx-scope': 'off',
	},
};
