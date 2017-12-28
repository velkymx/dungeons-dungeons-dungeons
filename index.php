<?php

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['info'] = array(

  'Character' => array(
    'Name' => 'Sir John',
    'Class' => 'Fighter',
    'Race' => 'Human',
    'Level' => 1,
    'Experience' => 0
  ),
  'stats' => array(
    'str' => 3,
    'dex' => 5,
    'wis' => 2,
    'int' => 0,
    'cha' => 0,
  ),
  'inventory' => array(
    'gold' => 100,
    'items' => array(
      'sword',
      'dagger',
      'shield',
      'boots'
    )
  )
);

function roll_dice($code){

  list($count,$size) = explode('d',$code);

  $result = 0;

  do {

    $result += rand(1,$size);

    $count--;

  } while($count > 0);

  return $result;

}

function encounter()
{
    $return = array(

    array('encounter'=>'Continue Straight'),
    array('encounter'=>'Continue Straight'),

    array('door'=>'Door'),
    array('door'=>'Door'),
    array('door'=>'Door'),

    array('passage_side'=>'Side Passage'),
    array('passage_side'=>'Side Passage'),
    array('passage_side'=>'Side Passage'),
    array('passage_side'=>'Side Passage'),
    array('passage_side'=>'Side Passage'),

    array('passage_turns'=>'Passage Turns'),
    array('passage_turns'=>'Passage Turns'),
    array('passage_turns'=>'Passage Turns'),

    array('chamber'=>'Chamber'),
    array('chamber'=>'Chamber'),
    array('chamber'=>'Chamber'),

    array('stairs'=>'Stairs'),
    array('secret_doors'=>'Dead End'),
    array('traps'=>'Trick/Trap Passage Continues'),
    array('monsters'=>'Wandering Monster'),

  );

    return $return[rand(0, 19)];
}

function secret_doors()
{
    $data = array(
      array('none'=>'Hidden Door'),
      array('none'=>'Hidden Door'),
      array('none'=>'Hidden Door'),

      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),
      array('none'=>'Nothing here.'),

    );

    $key = rand(0, 19);

    $label = $data[$key];

    $type = array(
      'Secret door',
      'Secret door',
      'Secret door',
      'Secret door',
      'Secret door',

      'One way door',
      'One way door',
      'One way door',
      'One way door',
      'One way door',

      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
      'Barred door',
    );


    if ($data[$key] == 'Hidden Door') {
        $label .= ': '.$type[rand(0, 19)];
    }

    return $label;
}

function stairs()
{
    $data = array(
      array('none'=>'Down 1 level*'),
      array('none'=>'Down 1 level*'),
      array('none'=>'Down 1 level*'),
      array('none'=>'Down 1 level*'),
      array('none'=>'Down 1 level*'),
      array('none'=>'Down 2 levels**'),
      array('none'=>'Down 3 levels***'),
      array('none'=>'Up 1 level'),
      array('none'=>'Up dead end'),
      array('none'=>'Down dead end'),
      array('none'=>'Chimney up 1 level'),
      array('none'=>'Chimney up 2 levels'),
      array('none'=>'Chimney down 2 levels'),
      array('none'=>'Trap door down 1 level, passage continues'),
      array('none'=>'Trap door down 1 level, passage continues'),
      array('none'=>'Trap door down 1 level, passage continues'),
      array('none'=>'Trap door down 2 levels, passage continues'),
      array('none'=>'Up 1 then down 2 (total down 1)'),
      array('none'=>'Up 1 then down 2 (total down 1)'),
      array('none'=>'Up 1 then down 2 (total down 1)'),
    );

    return $data[rand(0, 19)];
}

function door()
{
    $location = array(
      'On the left',
      'On the left',
      'On the left',
      'On the left',
      'On the left',
      'On the left',
      'On the right',
      'On the right',
      'On the right',
      'On the right',
      'On the right',
      'On the right',
      'In front of you',
      'In front of you',
      'In front of you',
      'In front of you',
      'In front of you',
      'In front of you',
      'In front of you',
      'In front of you'
  );

    $doors = array(

      array('none'=>'Parallel passage'),
      array('none'=>'Parallel passage'),
      array('none'=>'Parallel passage'),
      array('none'=>'Parallel passage'),
      array('none'=>'Passage Straight Ahead'),
      array('none'=>'Passage Straight Ahead'),
      array('none'=>'Passage Straight Ahead'),
      array('none'=>'Passage Straight Ahead'),

      array('none'=>'Passage 45 degrees ahead or behind'),
      array('none'=>'Passage 45 degrees behind or ahead'),

      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),
      array('room'=>'Room'),

      array('chamber'=>'Chamber'),
      array('chamber'=>'Chamber'),

  );

    $key = rand(0, 19);

    $name = current($doors[$key]);

    $side = $location[rand(0, 19)];

    return array(
      key($doors[$key]) =>
      $side.' is a door. Behind it is a ' .$name
    );
}

function passage_special()
{
    $data = array(
      array('encounter'=>'40’ columns down center'),
      array('encounter'=>'40’ columns down center'),
      array('encounter'=>'40’ columns down center'),
      array('encounter'=>'40’ columns down center'),
      array('encounter'=>'40’ double row of columns'),
      array('encounter'=>'40’ double row of columns'),
      array('encounter'=>'40’ double row of columns'),
      array('encounter'=>'50’ double row of columns '),
      array('encounter'=>'50’ double row of columns '),
      array('encounter'=>'50’ double row of columns '),
      array('encounter'=>'50’ columns 10’ right and left support 10’ wide upper galleries 20’ above'),
      array('encounter'=>'50’ columns 10’ right and left support 10’ wide upper galleries 20’ above'),
      array('none'=>'10’ stream'),
      array('none'=>'10’ stream'),
      array('none'=>'10’ stream'),
      array('none'=>'20’ river'),
      array('none'=>'20’ river'),
      array('none'=>'40’ river'),
      array('none'=>'60’ river'),
      array('none'=>'20’ chasm')
    );

    return $data[rand(0, 19)];
}

function passage_side()
{
    $data = array(
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Left 45 degrees ahead'),
      array('passage_width'=>'Right 45 degrees ahead'),
      array('passage_width'=>'Left 45 degrees behind '),
      array('passage_width'=>'Right 45 degrees behind'),
      array('passage_width'=>'Left curve 45 degrees behind'),
      array('passage_width'=>'Right curve 45 degrees behind'),
      array('passage_width'=>'Passage “T”'),
      array('passage_width'=>'Passage “T”'),
      array('passage_width'=>'Passage “T”'),
      array('passage_width'=>'Passage “Y”'),
      array('passage_width'=>'Passage “Y”'),
      array('passage_width'=>'Four way intersection'),
      array('passage_width'=>'Four way intersection'),
      array('passage_width'=>'Four way intersection'),
      array('passage_width'=>'Four way intersection'),
      array('passage_width'=>'Passage “X”')
    );

    return $data[rand(0, 19)];
}

function passage_width()
{
    $data = array(

    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 10’ wide.'),
    array('none'=>'The passage is 20’ wide.'),
    array('none'=>'The passage is 20’ wide.'),
    array('none'=>'The passage is 20’ wide.'),
    array('none'=>'The passage is 20’ wide.'),
    array('none'=>'The passage is 30’ wide.'),
    array('none'=>'The passage is 5’ wide.'),
    array('passage_special'=>'Special passage'),
    array('passage_special'=>'Special passage')

  );

    return $data[rand(0, 19)];
}

function passage_turns()
{
    $data = array(
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 90 degrees'),
      array('passage_width'=>'Left 45 degrees ahead'),
      array('passage_width'=>'Left 45 degrees behind'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 90 degrees'),
      array('passage_width'=>'Right 45 degrees ahead'),
      array('passage_width'=>'Right 45 degrees behind')

  );

    return $data[rand(0, 19)];
}

function chamber()
{
    return array('none'=>'Chamber Details');
};

function room_shape(){
  $int = rand(0,19);
  $data = array(
    array('none','Square, 10ft x 10ft'),
    array('none','Square, 10ft x 10ft'),
    array('none','Square, 20ft x 20ft'),
    array('none','Square, 20ft x 20ft'),
    array('none','Square, 30ft x 30ft'),
    array('none','Square, 30ft x 30ft'),
    array('none','Square, 40ft x 40ft'),
    array('none','Square, 40ft x 40ft'),
    array('none','Rectangular, 10ft x 20ft'),
    array('none','Rectangular, 10ft x 20ft'),
    array('none','Rectangular, 20ft x 30ft'),
    array('none','Rectangular, 20ft x 30ft'),
    array('none','Rectangular, 20ft x 40ft'),
    array('none','Rectangular, 20ft x 40ft'),
    array('none','Rectangular, 30ft x 40ft'),
    array('none','Rectangular, 30ft x 40ft'),
    array('unusual_shape','The room is an unusual shape.'),
    array('unusual_shape','The room is an unusual shape.'),
    array('unusual_shape','The room is an unusual shape.'),
  );

  return $data[$int];
}

 function unusual_shape()
{
    $size = array(
      array('none'=>'about 500 sqft'),
      array('none'=>'about 500 sqft'),
      array('none'=>'about 500 sqft'),
      array('none'=>'about 900 sqft'),
      array('none'=>'about 900 sqft'),
      array('none'=>'about 900 sqft'),
      array('none'=>'about 1500 sqft'),
      array('none'=>'about 1500 sqft'),
      array('none'=>'about 1500 sqft'),
      array('none'=>'about 2000 sqft'),
      array('none'=>'about 2000 sqft'),
      array('none'=>'about 2000 sqft'),
      array('none'=>'about 2700 sqft'),
      array('none'=>'about 2700 sqft'),
      array('none'=>'about 2700 sqft'),
      array('none'=>'about 3400 sqft'),
      array('none'=>'about 3400 sqft'),
      array('none'=>'about 3400 sqft'),
      array('none'=>rand(2000,3400).' sqft'),
      array('none'=>rand(2000,3400).' sqft'),
      array('none'=>rand(2000,3400).' sqft'),
      array('none'=>rand(2000,3400).' sqft'),
      array('none'=>rand(2000,3400).' sqft'),

    );

    $shape = array(
      array('none'=>'Circular'),
      array('none'=>'Circular'),
      array('none'=>'Circular'),
      array('none'=>'Circular'),
      array('none'=>'Circular'),
      array('none'=>'Triangular'),
      array('none'=>'Triangular'),
      array('none'=>'Triangular'),
      array('none'=>'Trapezoidal'),
      array('none'=>'Trapezoidal'),
      array('none'=>'Trapezoidal'),
      array('none'=>'Odd-shaped'),
      array('none'=>'Odd-shaped'),
      array('none'=>'Oval'),
      array('none'=>'Oval'),
      array('none'=>'Hexagonal'),
      array('none'=>'Hexagonal'),
      array('none'=>'Octagonal'),
      array('none'=>'Octagonal'),
      array('none'=>'Cave'),

    );

    return array('none'=>'This room is '.current($shape[rand(0,19)]).' about '.current($size[rand(0,19)]));
}

function room()
{
  $size = room_shape();
  if(key($size) == 'unusual_shape'){
    $size = unusual_shape();
  }

    return $size;
};

function traps()
{
    $data = array(

    array('secret_doors'=>'Secret Door'),
    array('secret_doors'=>'Secret Door'),
    array('secret_doors'=>'Secret Door'),
    array('secret_doors'=>'Secret Door'),
    array('secret_doors'=>'Secret Door'),

    array('none'=>'Pit, 10 ft deep - Dexterity DC 10 or fall for 1d8 damage'),
    array('none'=>'Pit, 10 ft deep - Dexterity DC 10 or fall for 1d8 damage'),

    array('none'=>'Spike Pit, 10 ft deep - Dexterity DC 10 or fall for 2d8 damage'),
    array('none'=>'Crushing Pit, 10 ft deep - Dexterity DC 10 or fall, walls move and crush victims in 1d4+1 rounds. 4d10 damage'),

    array('none'=>'20ft x 20ft elevator room. Decends one level.'),
    array('none'=>'20ft x 20ft elevator room. Decends 1d4+1 levels.'),

    array('none'=>'Arrow trap. 1d3 Arrows (1d8 damage) 5% chance poisoned'),
    array('none'=>'Spear trap. 1d3 Arrows (1d8 damage) 5% chance poisoned'),

    array('none'=>'Door falls outward causing 1d10 damage.'),
    array('none'=>'Ceiling collapses causing 2d10 damage.'),

    array('none'=>'Wall 10ft behind slides out and blocks passage.'),
    array('none'=>'Oil (equal to one flask) pours on random person from hole in ceiling, followed by flaming cinder (2d6 damage unless successful Wisdom DC 10 Check for 1/2 damage)'),
    array('none'=>'Gas; party has detected it, but must breathe i t to continue along corridor, as it covers 60ft ahead.'),
    array('none'=>'Illusionary wall concealing 8. (pit) above (1-6), 20.(chute) below (7-10) or chamber with monster and treasure (11-20)'),
    array('none'=>'Slide chute down 1 level (cannot be ascended in any manner).'),

  );

    return $data[rand(0, 19)];
};

function monsters()
{
    return array('none'=>'Monster Details');
};

function show_details($key)
{
    if ($key == 'none') {
        return 'none';
    }

    $next = $key();

    $key = key($next);

    echo ' ... '. current($next)."\n";

    return $key;
}

$encounter = encounter();

$key = key($encounter);

echo 'You come across a '.current($encounter)."\n";

do {
    $key = show_details($key);
} while ($key != 'none');

handle_input();


function handle_input()
{
    echo "What would you like to do? ('o'pen,fight,e'x'plore)";

    $handle = fopen("php://stdin", "r");

    $line = fgets($handle);

    // echo $line."\n";

    if (trim($line) === 'o') {
        echo '> Opening door. Beyond it you find:'."\n";

        $key = show_details('encounter');

        do {
            $key = show_details($key);
        } while ($key != 'none');

        handle_input();

        exit;
    }

    if (trim($line) === 'x') {
        echo '> You continue to explore:'."\n";

        $key = show_details('encounter');

        do {
            $key = show_details($key);
        } while ($key != 'none');

        handle_input();

        exit;
    }

    if (trim($line) === 'i') {
        echo '> Your Current Character:'."\n";

        foreach ($_SESSION['info'] as $cat => $info) {
            echo "\033[1m$cat\n";

            foreach ($info as $in => $iv) {
                if ($in == 'items') {
                    foreach ($iv as $i) {
                        echo "\t* $i\n";
                    }

                    continue;
                }

                echo "\t\033[1m$in: $iv\n";
            }
        };

        handle_input();

        exit;
    }

    if (trim($line) === 'add gold') {
        echo '> Your Current Character:'."\n";

        $_SESSION['info']['inventory']['gold'] += 10;

        foreach ($_SESSION['info'] as $cat => $info) {
            echo "\033[1m$cat\n";

            foreach ($info as $in => $iv) {
                if ($in == 'items') {
                    foreach ($iv as $i) {
                        echo "\t* $i\n";
                    }

                    continue;
                }

                echo "\t\033[1m$in: $iv\n";
            }
        };

        handle_input();

        exit;
    }

    if (trim($line) === 'add exp') {
        echo '> Your Current Character:'."\n";

        $_SESSION['info']['character']['experience'] += 10;

        foreach ($_SESSION['info'] as $cat => $info) {
            echo "\033[1m$cat\n";

            foreach ($info as $in => $iv) {
                if ($in == 'items') {
                    foreach ($iv as $i) {
                        echo "\t* $i\n";
                    }

                    continue;
                }

                echo "\t\033[1m$in: $iv\n";
            }
        };

        handle_input();

        exit;
    }

    if (substr(trim($line), 0, 4) === 'roll') {

      $trim = substr(trim($line), 5);

      $roll = roll_dice($trim);

      echo "You rolled $trim and got $roll!\n";

      handle_input();

    }

    if (substr(trim($line), 0, 4) === 'drop') {
        $trim = substr(trim($line), 5);

        if (array_search($trim, $_SESSION['info']['inventory']['items']) >= 0) {

            unset($_SESSION['info']['inventory']['items'][array_search($trim, $_SESSION['info']['inventory']['items'])]);

            echo 'Item "'.$trim.'" Dropped'."\n";

        } else {
            echo 'You don\'t have a "'.$trim.'" to drop'."\n";
        }

        foreach ($_SESSION['info'] as $cat => $info) {
            echo "\033[1m$cat\n";

            foreach ($info as $in => $iv) {
                if ($in == 'items') {
                    foreach ($iv as $i) {
                        echo "\t* $i\n";
                    }

                    continue;
                }

                echo "\t\033[1m$in: $iv\n";
            }
        };

        handle_input();

        exit;
    }

    if (substr(trim($line), 0, 4) === 'take') {
        $trim = substr(trim($line), 5);

        if (array_search($trim, $_SESSION['info']['inventory']['items']) !== false) {

          echo 'You already have a '.$trim."\n";

        } else {

          $_SESSION['info']['inventory']['items'][] = $trim;

          echo 'Item "'.$trim.'" Taken'."\n";

        }

        foreach ($_SESSION['info'] as $cat => $info) {
            echo "\033[1m$cat\n";

            foreach ($info as $in => $iv) {
                if ($in == 'items') {
                    foreach ($iv as $i) {
                        echo "\t* $i\n";
                    }

                    continue;
                }

                echo "\t\033[1m$in: $iv\n";
            }
        };

        handle_input();

        exit;
    }

    fclose($handle);
}
