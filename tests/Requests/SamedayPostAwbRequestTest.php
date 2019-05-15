<?php

namespace Sameday\Tests\Requests;

use Sameday\Objects\ParcelDimensionsObject;
use Sameday\Objects\PostAwb\Request\AwbRecipientEntityObject;
use Sameday\Objects\PostAwb\Request\CompanyEntityObject;
use Sameday\Objects\PostAwb\Request\ThirdPartyPickupEntityObject;
use Sameday\Objects\Types\AwbPaymentType;
use Sameday\Objects\Types\CodCollectorType;
use Sameday\Objects\Types\DeliveryIntervalServiceType;
use Sameday\Objects\Types\PackageType;
use Sameday\Requests\SamedayPostAwbRequest;

class SamedayPostAwbRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $packageType = new PackageType(PackageType::LARGE);
        $awbPaymentType = new AwbPaymentType(AwbPaymentType::CLIENT);
        $awbRecipient = new AwbRecipientEntityObject('city', 'county', 'address', 'name', 'phone', 'email');
        $codCollectorType = new CodCollectorType(CodCollectorType::CLIENT);
        $thirdPartyEntity = new ThirdPartyPickupEntityObject('city', 'county', 'address', 'name', 'phone', new CompanyEntityObject('name', 'cui', 'onrc', 'iban', 'bank'));
        $deliveryIntervalServiceType = new DeliveryIntervalServiceType(1000);

        $request = new SamedayPostAwbRequest(
            1,
            2,
            $packageType,
            [
                new ParcelDimensionsObject(1),
                new ParcelDimensionsObject(1, 2, 3, 4),
            ],
            3,
            $awbPaymentType,
            $awbRecipient,
            100,
            110,
            $codCollectorType,
            $thirdPartyEntity,
            [11, 12, 13],
            $deliveryIntervalServiceType,
            'reference',
            'observation',
            'priceObservation',
            'clientObservation',
            10
        );

        $this->assertEquals(1, $request->getPickupPointId());
        $this->assertEquals(2, $request->getContactPersonId());
        $this->assertEquals($packageType, $request->getPackageType());
        $this->assertCount(2, $request->getParcelsDimensions());
        $this->assertEquals(3, $request->getServiceId());
        $this->assertEquals($awbPaymentType, $request->getAwbPayment());
        $this->assertEquals($awbRecipient, $request->getAwbRecipient());
        $this->assertEquals(100, $request->getInsuredValue());
        $this->assertEquals(110, $request->getCashOnDeliveryAmount());
        $this->assertEquals($codCollectorType, $request->getCashOnDeliveryCollector());
        $this->assertEquals($thirdPartyEntity, $request->getThirdPartyPickup());
        $this->assertCount(3, $request->getServiceTaxIds());
        $this->assertEquals($deliveryIntervalServiceType, $request->getDeliveryIntervalServiceType());
        $this->assertEquals('reference', $request->getReference());
        $this->assertEquals('observation', $request->getObservation());
        $this->assertEquals('priceObservation', $request->getPriceObservation());
        $this->assertEquals('clientObservation', $request->getClientObservation());
        $this->assertEquals(10, $request->getLockerId());
    }

    public function testSetGet()
    {
        $request = new SamedayPostAwbRequest(
            1,
            2,
            new PackageType(PackageType::LARGE),
            [new ParcelDimensionsObject(1)],
            3,
            new AwbPaymentType(AwbPaymentType::CLIENT),
            new AwbRecipientEntityObject('city', 'county', 'address', 'name', 'phone', 'email'),
            100
        );

        $packageType = new PackageType(PackageType::PARCEL);
        $awbPaymentType = new AwbPaymentType(AwbPaymentType::CLIENT);
        $awbRecipient = new AwbRecipientEntityObject('city', 'county', 'address', 'name', 'phone', 'email');
        $codCollectorType = new CodCollectorType(CodCollectorType::CLIENT);
        $thirdPartyEntity = new ThirdPartyPickupEntityObject('city', 'county', 'address', 'name', 'phone', new CompanyEntityObject('name', 'cui', 'onrc', 'iban', 'bank'));
        $deliveryIntervalServiceType = new DeliveryIntervalServiceType(1000);

        $request->setPickupPointId(10);
        $request->setContactPersonId(20);
        $request->setPackageType($packageType);
        $request->setParcelsDimensions([]);
        $request->setServiceId(30);
        $request->setAwbPayment($awbPaymentType);
        $request->setAwbRecipient($awbRecipient);
        $request->setInsuredValue(110);
        $request->setCashOnDeliveryAmount(120);
        $request->setCashOnDeliveryCollector($codCollectorType);
        $request->setThirdPartyPickup($thirdPartyEntity);
        $request->setServiceTaxIds([0]);
        $request->setDeliveryIntervalServiceType($deliveryIntervalServiceType);
        $request->setReference('reference');
        $request->setObservation('observation');
        $request->setPriceObservation('priceObservation');
        $request->setClientObservation('clientObservation');
        $request->setLockerId(10);

        $this->assertEquals(10, $request->getPickupPointId());
        $this->assertEquals(20, $request->getContactPersonId());
        $this->assertEquals($packageType, $request->getPackageType());
        $this->assertCount(0, $request->getParcelsDimensions());
        $this->assertEquals(30, $request->getServiceId());
        $this->assertEquals($awbPaymentType, $request->getAwbPayment());
        $this->assertEquals($awbRecipient, $request->getAwbRecipient());
        $this->assertEquals(110, $request->getInsuredValue());
        $this->assertEquals(120, $request->getCashOnDeliveryAmount());
        $this->assertEquals($codCollectorType, $request->getCashOnDeliveryCollector());
        $this->assertEquals($thirdPartyEntity, $request->getThirdPartyPickup());
        $this->assertCount(1, $request->getServiceTaxIds());
        $this->assertEquals($deliveryIntervalServiceType, $request->getDeliveryIntervalServiceType());
        $this->assertEquals('reference', $request->getReference());
        $this->assertEquals('observation', $request->getObservation());
        $this->assertEquals('priceObservation', $request->getPriceObservation());
        $this->assertEquals('clientObservation', $request->getClientObservation());
        $this->assertEquals(10, $request->getLockerId());
    }

    public function testBuildRequestWithoutLockerId()
    {
        $packageType = new PackageType(PackageType::LARGE);
        $awbPaymentType = new AwbPaymentType(AwbPaymentType::CLIENT);
        $awbRecipient = new AwbRecipientEntityObject('city', 'county', 'address', 'name', 'phone', 'email');
        $codCollectorType = new CodCollectorType(CodCollectorType::CLIENT);
        $thirdPartyEntity = new ThirdPartyPickupEntityObject(1, 2, 'address', 'name', 'phone', new CompanyEntityObject('name', 'cui', 'onrc', 'iban', 'bank'));
        $deliveryIntervalServiceType = new DeliveryIntervalServiceType(1000);

        $request = new SamedayPostAwbRequest(
            1,
            2,
            $packageType,
            [
                new ParcelDimensionsObject(1),
                new ParcelDimensionsObject(1, 2, 3, 4),
            ],
            3,
            $awbPaymentType,
            $awbRecipient,
            100,
            110,
            $codCollectorType,
            $thirdPartyEntity,
            [11, 12, 13],
            $deliveryIntervalServiceType,
            'reference',
            'observation',
            'priceObservation',
            'clientObservation'
        );
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('POST', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb', $samedayRequest->getEndpoint());
        $this->assertEquals('pickupPoint=1&contactPerson=2&packageType=2&packageNumber=2&packageWeight=2&service=3&awbPayment=1&cashOnDelivery=110&cashOnDeliveryReturns=1&insuredValue=100&thirdPartyPickup=1&thirdParty%5Bname%5D=name&thirdParty%5BphoneNumber%5D=phone&thirdParty%5Baddress%5D=address&thirdParty%5BpersonType%5D=1&thirdParty%5Bcity%5D=1&thirdParty%5Bcounty%5D=2&thirdParty%5BcompanyName%5D=name&thirdParty%5BcompanyCui%5D=cui&thirdParty%5BcompanyOnrcNumber%5D=onrc&thirdParty%5BcompanyIban%5D=iban&thirdParty%5BcompanyBank%5D=bank&serviceTaxes%5B0%5D=11&serviceTaxes%5B1%5D=12&serviceTaxes%5B2%5D=13&deliveryInterval=1000&awbRecipient%5Bname%5D=name&awbRecipient%5BphoneNumber%5D=phone&awbRecipient%5Baddress%5D=address&awbRecipient%5BpersonType%5D=0&awbRecipient%5BcityString%5D=city&awbRecipient%5BcountyString%5D=county&awbRecipient%5Bemail%5D=email&parcels%5B0%5D%5Bweight%5D=1&parcels%5B1%5D%5Bweight%5D=1&parcels%5B1%5D%5Bwidth%5D=2&parcels%5B1%5D%5Blength%5D=3&parcels%5B1%5D%5Bheight%5D=4&observation=observation&priceObservation=priceObservation&clientInternalReference=reference&clientObservation=clientObservation', $samedayRequest->getBody()->getBody());
    }

    public function testBuildRequest()
    {
        $packageType = new PackageType(PackageType::LARGE);
        $awbPaymentType = new AwbPaymentType(AwbPaymentType::CLIENT);
        $awbRecipient = new AwbRecipientEntityObject('city', 'county', 'address', 'name', 'phone', 'email');
        $codCollectorType = new CodCollectorType(CodCollectorType::CLIENT);
        $thirdPartyEntity = new ThirdPartyPickupEntityObject(1, 2, 'address', 'name', 'phone', new CompanyEntityObject('name', 'cui', 'onrc', 'iban', 'bank'));
        $deliveryIntervalServiceType = new DeliveryIntervalServiceType(1000);

        $request = new SamedayPostAwbRequest(
            1,
            2,
            $packageType,
            [
                new ParcelDimensionsObject(1),
                new ParcelDimensionsObject(1, 2, 3, 4),
            ],
            3,
            $awbPaymentType,
            $awbRecipient,
            100,
            110,
            $codCollectorType,
            $thirdPartyEntity,
            [11, 12, 13],
            $deliveryIntervalServiceType,
            'reference',
            'observation',
            'priceObservation',
            'clientObservation',
            10
        );
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('POST', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb', $samedayRequest->getEndpoint());
        $this->assertEquals('pickupPoint=1&contactPerson=2&packageType=2&packageNumber=2&packageWeight=2&service=3&awbPayment=1&cashOnDelivery=110&cashOnDeliveryReturns=1&insuredValue=100&thirdPartyPickup=1&thirdParty%5Bname%5D=name&thirdParty%5BphoneNumber%5D=phone&thirdParty%5Baddress%5D=address&thirdParty%5BpersonType%5D=1&thirdParty%5Bcity%5D=1&thirdParty%5Bcounty%5D=2&thirdParty%5BcompanyName%5D=name&thirdParty%5BcompanyCui%5D=cui&thirdParty%5BcompanyOnrcNumber%5D=onrc&thirdParty%5BcompanyIban%5D=iban&thirdParty%5BcompanyBank%5D=bank&serviceTaxes%5B0%5D=11&serviceTaxes%5B1%5D=12&serviceTaxes%5B2%5D=13&deliveryInterval=1000&awbRecipient%5Bname%5D=name&awbRecipient%5BphoneNumber%5D=phone&awbRecipient%5Baddress%5D=address&awbRecipient%5BpersonType%5D=0&awbRecipient%5BcityString%5D=city&awbRecipient%5BcountyString%5D=county&awbRecipient%5Bemail%5D=email&parcels%5B0%5D%5Bweight%5D=1&parcels%5B1%5D%5Bweight%5D=1&parcels%5B1%5D%5Bwidth%5D=2&parcels%5B1%5D%5Blength%5D=3&parcels%5B1%5D%5Bheight%5D=4&observation=observation&priceObservation=priceObservation&clientInternalReference=reference&clientObservation=clientObservation&lockerId=10', $samedayRequest->getBody()->getBody());
    }
}
