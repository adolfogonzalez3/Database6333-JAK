<?
function login($username, $password) {
    // Connect to database
    // Retrieve passwordHash and passwordSalt from user table where ID = $username
    // if no record exists with $username then return false
    // else
    //  add passwordSalt to end of $password
    //  hash $password
    //  if $password = passwordHash
    //      return true
    //  else
    //      return false
}
?>
