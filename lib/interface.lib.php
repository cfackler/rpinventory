<?php
/*

  Copyright (C) 2008, All Rights Reserved.

  This file is part of RPInventory.

  RPInventory is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  RPInventory is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with RPInventory.  If not, see <http://www.gnu.org/licenses/>.

*/

function generateTableHeader($params, &$smarty)
{
  $headers = $params['headers'];
  $currentSortIndex = $params['currentSortIndex'];
  $currentSortDir = $params['currentSortDir'];

  $i = 0;
  foreach($headers as $header)
  {
    print '<th width="'.$header['width'].'">';
    print '<a href="?sort='.$i.'&sortdir=';

    //If this is column is currently being sorted by
    if($currentSortIndex == $i)
    {
      //figure out sort direction to put in link
      // 0:ascending, 1:descending
      if($currentSortDir == 0)
        print '1';
      else
        print '0';
      
      print '">'.$header['label']."&nbsp;";
      
      //figure out which sort triangle to put
      print '<img class="tableHeaderSortTriangle" src="images/sortTriangle';
      if($currentSortDir == 0)
        print 'Up.png" />';
      else
        print 'Down.png" />';
    }
    else
    {
      print '0">';
      print $header['label'];
    }
    print '</a></th>';
    $i++;
  }
  
}


?>