import React, { Component } from 'react';
import { Container, Row, Col } from 'reactstrap';
import PacketModal from '../modal/PacketModal.jsx';
import PacketTable from '../table/PacketTable.jsx';
import '../assets/scss/packet.scss';
import { CSVLink } from "react-csv";

class packet extends Component {
    state = {
        packets: []
    }

    getPackets(){
        fetch('http://localhost/siklin/packetsiklin/packets')
        .then(response => response.json())
        .then(packets => this.setState({packets}))
        .catch(err => console.log(err))
    }

    addPacketToState = (packet) => {
        this.setState(prevState => ({
            packets: [...prevState.packets, packet]
        }))
    }
    
    updateState = (packet) => {
        const packetIndex = this.state.packets.findIndex(data => data.id === packet.id)
        const newArray = [
            // destructure all items from beginning to the indexed item
            ...this.state.packets.slice(0, packetIndex),
            // add the updated item to the array
            packet,
            // add the rest of the items to the array from the index after the replaced item
            ...this.state.packets.slice(packetIndex + 1)
        ]
        this.setState({ packets: newArray })
    }

    deletePacketFromState = (id) => {
        const updatedPackets = this.state.packets.filter(packet => packet.id !== id)
        this.setState({ packets: updatedPackets })
    }

    componentDidMount(){
        this.getPackets()
    }

    render() {
        return (
            <Container className="Packet">
                <Row>
                    <Col>
                        <h1 style={{ margin: "20px 0" }}>Packet Laundry</h1>
                    </Col>
                </Row>
                <Row>
                    <Col>
                        <PacketTable packets={this.state.packets} updateState={this.updateState} deletePacketFromState={this.deletePacketFromState}/>
                    </Col>
                </Row>
                <Row>
                    <Col>
                        <CSVLink 
                            filename={"packetList.csv"}
                            color="primary"
                            style={{ float:"left", marginRight: "10px" }}
                            className="btn btn-primary"
                            data={this.state.packets}
                        >Download CSV</CSVLink>
                        <PacketModal buttonLabel="Add Packet" addPacketToState={this.addPacketToState}/>
                    </Col>
                </Row>
            </Container>
        )
    }
}

export default packet;