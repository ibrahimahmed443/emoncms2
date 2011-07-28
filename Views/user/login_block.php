<!--
   All Emoncms code is released under the GNU General Public License v3.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
-->
<div style="text-align:right">
<form action="<?php echo $GLOBALS['path']; ?>" method="post">
  <table>
  <tr><td>Username:</td><td><input type="text" name="username" style="width:152px"/></td></tr>
  <tr><td>Password:</td><td><input type="password" name="password" style="width:152px"/></td></tr>
  <tr><td></td><td><input type="submit" name="form" value="login" /> or <input type="submit" name="form" value="register" /></td></tr>
  </table>
  <?php echo $error; ?>
</form>
</div>

