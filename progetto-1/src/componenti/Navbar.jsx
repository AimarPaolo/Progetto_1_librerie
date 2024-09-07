import React from 'react';

const Navbar = () => {
  return (
    <div className="navbar">
      <a href="home.html">Home</a>
      <a href="acquisto.php">Acquista un biglietto</a>
      <a href="logout.php">Logout</a>
      <a href="carrello.php">Carrello Acquisti</a>
    </div>
  );
};

export default Navbar;