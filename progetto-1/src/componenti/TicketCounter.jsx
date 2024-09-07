import React from 'react';

const TicketCounter = ({ totalTickets, cost, onIncrement, onDecrement }) => {
  return (
    <div>
      <span className="contatore">
        <button onClick={onDecrement}>-</button>
        <input type="text" readOnly value={totalTickets} />
        <button onClick={onIncrement}>+</button>
        <span className="costoBiglietto">Costo del biglietto: {cost}€</span>
      </span>
      <div className="costoTotale">
        Il costo totale dei biglietti selezionati per questo evento è: {totalTickets * cost} €
      </div>
    </div>
  );
};

export default TicketCounter;