MetaModels API
==============

The MetaModels API consists of serveral interfaces which are the only API that should be considered immutable. Classes
of the core and their private, protected and even public methods should generally NOT be considered immutable and may
be changed over minor versions and patch releases.

During the alpha and beta phase of a new MetaModels major release, there may be changes to interfaces as well.
Therefore the API should not be considered immutable during major development cycles.

An deprecation phase will be provided during minor cycles, denoting that a certain feature of the API will get dropped
in the next major release. We will try to put the replacement already in place but for bigger breaks this will not be
possible. The breaks will however be announced in an draft, along with an upgrade guide, prior to release as soon as the
new interfaces are defined.

Core Interfaces
---------------

