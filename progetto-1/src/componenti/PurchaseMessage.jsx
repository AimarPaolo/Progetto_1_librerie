import React from 'react';

const PurchaseMessage = ({ message }) => {
  return message ? <p className="successo">{message}</p> : null;
};

export default PurchaseMessage;