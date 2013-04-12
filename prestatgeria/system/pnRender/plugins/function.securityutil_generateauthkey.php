<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2004, Zikula Development Team
 * @link http://www.zikula.org
 * @version $Id: function.securityutil_generateauthkey.php 27274 2009-10-30 13:49:20Z mateo $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Template_Plugins
 * @subpackage Functions
 */

/**
 * Smarty function to generate a unique key to secure forms content as unique.
 *
 * As the MGD states, all operations protected by pnSecAuthAction(). Ih the form,
 * you generate a hidden field with the authid in your form, and check the authid
 * in the submission. T.this way you can be sure that the data was given in your
 * form (and not given by any POST/GET data from outside)
 *
 * Note that you must not cache the outputs from this function, as its results
 * change aech time it is called. The Zikula developers are looking for ways to
 * automise this.
 *
 *
 * Available parameters:
 *   - module:   The well-known name of a module to execute a function from (required)
 *   - assign:   If set, the results are assigned to the corresponding variable instead of printed out
 *
 * Example
 *   <input type="hidden" name="authid" value="<!--[securityutil_generateauthkey module='MyModule']-->">
 *
 *
 * @author       Mark West
 * @since        08/08/2003
 * @todo         prevent this function from being cached (Smarty 2.6.0)
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$smarty     Reference to the Smarty object
 * @return       string      the authentication key
 * @deprecated
 */
function smarty_function_securityutil_generateauthkey($params, &$smarty)
{
    if (!isset($params['module'])) {
        $smarty->trigger_error(__f('Error! in %1$s: the %2$s parameter must be specified.', array('securityutil_generateauthkey', 'module')));
        return false;
    }

    $result = SecurityUtil::generateAuthKey($params['module']);

    if (isset($params['assign'])) {
        $smarty->assign($params['assign'], $result);
    } else {
        return $result;
    }
}
