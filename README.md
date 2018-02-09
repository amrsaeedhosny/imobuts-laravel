# Intelligent Mobile Bus Ticketing System
The issue of fast, safe, and non-distracting payment method is very
paramount in any transportation, especially if it affects the safety of
passengers. Therefore, an efficient solution has to be applied to enforce the
separation of driving the vehicle and issuing tickets responsibilities.
Our solution intends to replace old-fashioned methods of issuing
tickets by an efficient digital system that falls under the realm of internet
of things (IoT). A software application is downloaded on the passenger’s
smartphone. Every passenger can have an account on that application
containing his/her information. The passenger’s account can be charged
with a predetermined amount of balance specified by the passenger at
anytime and anyplace. Once enough balance is charged on the account, the
passenger can ride any transportation that provides our digital service. The
transportation contains an attached IoT device in which passenger can pass
his/her smartphone over. That IoT device works as a reader to check
passenger’s balance against the transportation ticket price. After the
process of validation, the IoT device communicates with a back-end server
which in turn sends a digital ticket to passenger’s account and deducts the
price of the ticket from the current balance. At this moment, the passenger
has a digital ticket on his/her smartphone containing the necessary details
that work as a proof of payment.
  The tools used to implement our solution are Android, PHP Laravel
framework, MySQL database, and Near Field Communication technology
(NFC). Android is used as a front-end technology representing the mobile
application downloaded on the passenger’s smartphone. NFC technology is
used in both smartphones and the IoT device mentioned earlier as a way of
communication between them. Modern smarphones come with NFC
component which is mostly attached to their back. The IoT device device
consists of a board which is connected to NFC component. PHP Laravel is
used as back-end server framework representing the implementation of our
services. PHP Laravel communicates with MySQL database to store and
retrieve passengers’ data.
