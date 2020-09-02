import React, { Component } from 'react';
import { Table, Button } from 'reactstrap';
import PacketModal from '../modal/PacketModal.jsx';

class PacketTable extends Component {
    
    deletePacket = id => {
        let confirmDelete = window.confirm('Apakah Kamu Yakin Ingin hapus Paket ini ?')
        if(confirmDelete){
            fetch('http://localhost/siklin/packetsiklin/delete_packet/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id
                })
            }).then (response => response.json)
            .then((packet) => {
                this.props.deletePacketFromState(id)
            }).catch(err => console.log(err))
        }
    }

    render() {
        const packets = this.props.packets.map(packet => {
            return (
                <tr key={packet.id}>
                    <td>{packet.packet_id}</td>
                    <td>{packet.packet_name}</td>
                    <td>{packet.packet_price}</td>
                    <td>
                        <center>
                            <div style={{ width: "110px" }}>
                                <PacketModal buttonLabel="Edit" packet={packet} updateState={this.props.updateState}/>
                                {' '}
                                <Button color="danger" onClick={() => this.deletePacket(packet.id)}> Delete </Button>
                            </div>
                        </center>
                    </td>
                </tr>
            )
        })  
        
        return(
            <Table responsive hover>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {packets}
                </tbody>
            </Table>
        )
    }
}

export default PacketTable;