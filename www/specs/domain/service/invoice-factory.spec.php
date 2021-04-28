<?php

use CleanPhp\Invoicer\Domain\Entity\Order;
use CleanPhp\Invoicer\Domain\Factory\InvoiceFactory;

describe('InvoiceFactory', function () {
  beforeEach(function () {
    $this->order = new Order();
    $this->factory = new InvoiceFactory();
  });

  describe('->createFromOrder()', function () {
    it('should return an order object', function () {
      $invoice = $this->factory->createFromOrder($this->order);
      expect($invoice)->to->be->instanceof(
        'CleanPhp\Invoicer\Domain\Entity\Invoice'
      );
    });

    it('should set the total of the invoice', function () {
      $this->order->setTotal(500);
      $invoice = $this->factory->createFromOrder($this->order);
      expect($invoice->getTotal())->to->equal(500);
    });

    it('should associate the Order to the Invoice', function () {
      $invoice = $this->factory->createFromOrder($this->order);
      expect($invoice->getOrder())->to->equal($this->order);
    });


    it('should set the date of the Invoice', function () {
      $invoice = $this->factory->createFromOrder($this->order);
      expect(($invoice->getInvoiceDate())->getTimestamp())
        ->to->loosely->equal((new DateTime())->getTimestamp());
    });
  });
});
