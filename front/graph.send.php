<?php

/*
   ------------------------------------------------------------------------
   TimelineTicket
   Copyright (C) 2013-2016 by the TimelineTicket Development Team.

   https://github.com/pluginsGLPI/timelineticket
   ------------------------------------------------------------------------

   LICENSE

   This file is part of TimelineTicket project.

   TimelineTicket plugin is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   TimelineTicket plugin is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with TimelineTicket plugin. If not, see <http://www.gnu.org/licenses/>.

   ------------------------------------------------------------------------

   @package   TimelineTicket plugin
   @copyright Copyright (c) 2013-2016 TimelineTicket team
   @license   AGPL License 3.0 or (at your option) any later version
              http://www.gnu.org/licenses/agpl-3.0-standalone.html
   @link      https://github.com/pluginsGLPI/timelineticket
   @since     2013

   ------------------------------------------------------------------------
 */

include ('../../../inc/includes.php');

Session ::checkLoginUser();

if (isset($_GET["switchto"])) {
   $_SESSION['glpigraphtype'] = $_GET["switchto"];
   Html::back();
}

if (($uid = Session::getLoginUserID(false))
    && isset($_GET["file"])) {

   list($userID,$filename) = explode("_", $_GET["file"]);
   if (($userID == $uid)
       && file_exists(GLPI_GRAPH_DIR."/".$_GET["file"])) {

      list($fname,$extension)=explode(".", $filename);
      Toolbox::sendFile(GLPI_GRAPH_DIR."/".$_GET["file"], 'glpi.'.$extension);
   } else {
      Html::displayErrorAndDie(__('Unauthorized access to this file'), true);
   }
}
